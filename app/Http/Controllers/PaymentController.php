<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.serverKey');
        Config::$isProduction = config('midtrans.isProduction');
        Config::$isSanitized = config('midtrans.isSanitized');
        Config::$is3ds = config('midtrans.is3ds');
    }

    // Tambahkan method rent now
    public function rentNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'delivery_option' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:delivery_option,delivery',
            'phone_number' => 'required_if:delivery_option,delivery',
            'recipient_name' => 'required_if:delivery_option,delivery'
        ]);

        // Hitung rental days
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        $rentalDays = $startDate->diffInDays($endDate) + 1;

        // Validasi maksimal 7 hari
        if ($rentalDays > 7) {
            return back()->with('error', 'Maximum rental period is 7 days.');
        }

        // Simpan data rental ke session
        $rentalData = [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rental_days' => $rentalDays,
            'delivery_option' => $request->delivery_option,
            'delivery_address' => $request->delivery_address,
            'phone_number' => $request->phone_number,
            'recipient_name' => $request->recipient_name,
            'notes' => $request->notes
        ];

        session(['rental_data' => $rentalData]);

        return redirect()->route('payment');
    }

    public function payment()
    {
        $rentalData = session('rental_data');
        
        if (!$rentalData) {
            return redirect()->route('catalog')->with('error', 'No rental data found.');
        }

        $product = Product::with('images')->findOrFail($rentalData['product_id']);
        
        // Calculate pricing
        $subtotal = $product->price * $rentalData['quantity'] * $rentalData['rental_days'];
        $serviceFee = 5000; // Fixed service fee
        $deposit = $subtotal * 0.5; // 50% deposit
        $shippingCost = $rentalData['delivery_option'] === 'delivery' ? 10000 : 0;
        $total = $subtotal + $serviceFee + $deposit + $shippingCost;

        $paymentData = [
            'product' => $product,
            'rental_data' => $rentalData,
            'pricing' => [
                'subtotal' => $subtotal,
                'service_fee' => $serviceFee,
                'deposit' => $deposit,
                'shipping_cost' => $shippingCost,
                'total' => $total
            ]
        ];

        return view('pages.customer.paymentcust', compact('paymentData'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'terms' => 'required|accepted'
        ]);

        $rentalData = session('rental_data');
        
        if (!$rentalData) {
            return response()->json([
                'success' => false,
                'message' => 'Rental data not found'
            ], 400);
        }

        try {
            // Create order first
            $product = Product::findOrFail($rentalData['product_id']);
            
            // Calculate pricing again for security
            $subtotal = $product->price * $rentalData['quantity'] * $rentalData['rental_days'];
            $serviceFee = 5000;
            $deposit = $subtotal * 0.5;
            $shippingCost = $rentalData['delivery_option'] === 'delivery' ? 10000 : 0;
            $total = $subtotal + $serviceFee + $deposit + $shippingCost;

            // Generate unique order code
            $orderCode = 'FST-' . date('Ymd') . '-' . strtoupper(uniqid());

            // Create order in database
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => $orderCode,
                'total_amount' => $total,
                'status' => 'pending',
                'start_date' => $rentalData['start_date'],
                'end_date' => $rentalData['end_date'],
                'payment_status' => 'unpaid',
                'delivery_option' => $rentalData['delivery_option'],
                'delivery_address' => $rentalData['delivery_address'] ?? null,
                'phone_number' => $rentalData['phone_number'] ?? null,
                'recipient_name' => $rentalData['recipient_name'] ?? null,
                'notes' => $rentalData['notes'] ?? null
            ]);

            // Add order items
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $rentalData['quantity'],
                'unit_price' => $product->price,
                'subtotal' => $subtotal
            ]);

            // Prepare item details for Midtrans
            $itemDetails = [
                [
                    'id' => $product->id,
                    'price' => $product->price * $rentalData['rental_days'],
                    'quantity' => $rentalData['quantity'],
                    'name' => $product->name . ' (Rental ' . $rentalData['rental_days'] . ' days)'
                ]
            ];

            // Add service fee as separate item
            if ($serviceFee > 0) {
                $itemDetails[] = [
                    'id' => 'service_fee',
                    'price' => $serviceFee,
                    'quantity' => 1,
                    'name' => 'Service Fee'
                ];
            }

            // Add deposit as separate item
            if ($deposit > 0) {
                $itemDetails[] = [
                    'id' => 'deposit',
                    'price' => $deposit,
                    'quantity' => 1,
                    'name' => 'Security Deposit (50%)'
                ];
            }

            // Add shipping cost if delivery
            if ($shippingCost > 0) {
                $itemDetails[] = [
                    'id' => 'shipping',
                    'price' => $shippingCost,
                    'quantity' => 1,
                    'name' => 'Delivery Fee'
                ];
            }

            // Customer details
            $customerDetails = [
                'first_name' => auth()->user()->name,
                'last_name' => '',
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone ?? '081234567890'
            ];

            // Prepare transaction details for Midtrans
            $transactionDetails = [
                'order_id' => $orderCode,
                'gross_amount' => $total
            ];

            // Set enabled payments based on selected method
            $enabledPayments = [];
            switch ($request->payment_method) {
                case 'qris':
                    $enabledPayments = ['qris'];
                    break;
                case 'bank':
                    $enabledPayments = ['bank_transfer'];
                    break;
                case 'ewallet':
                    $enabledPayments = ['gopay', 'shopeepay', 'dana'];
                    break;
                default:
                    $enabledPayments = ['qris', 'bank_transfer', 'gopay', 'shopeepay', 'dana'];
            }

            // Midtrans transaction parameters
            $params = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
                'enabled_payments' => $enabledPayments,
                'callbacks' => [
                    'finish' => route('payment.finish')
                ],
                'expiry' => [
                    'start_time' => date('Y-m-d H:i:s O'),
                    'unit' => 'minutes',
                    'duration' => 60
                ]
            ];

            // Get Snap Token
            $snapToken = Snap::getSnapToken($params);

            // Store order ID in session for later use
            session(['current_order_id' => $order->id]);

            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_code' => $orderCode
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function paymentFinish(Request $request)
    {
        $orderId = session('current_order_id');
        
        if ($orderId) {
            $order = Order::find($orderId);
            if ($order) {
                return redirect()->route('order.success', $order->order_code);
            }
        }

        return redirect()->route('home')->with('success', 'Payment completed successfully!');
    }

    public function paymentNotification(Request $request)
    {
        try {
            $notification = new Notification();
            
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status;
            $orderId = $notification->order_id;

            // Find order by order_code
            $order = Order::where('order_code', $orderId)->first();
            
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Handle different transaction statuses
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->update([
                        'payment_status' => 'partial',
                        'status' => 'pending'
                    ]);
                } else if ($fraudStatus == 'accept') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'confirmed'
                    ]);
                }
            } else if ($transactionStatus == 'settlement') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed'
                ]);
            } else if ($transactionStatus == 'pending') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'pending'
                ]);
            } else if ($transactionStatus == 'deny') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled'
                ]);
            } else if ($transactionStatus == 'expire') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled'
                ]);
            } else if ($transactionStatus == 'cancel') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled'
                ]);
            }

            return response()->json(['message' => 'Notification handled successfully']);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}