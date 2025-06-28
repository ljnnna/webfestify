<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderProduct;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;
use App\Models\Cart;


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
        $orderId = session('current_order_id');
    
        if (!$rentalData && !$orderId) {
            return response()->json([
                'success' => false,
                'message' => 'Rental data not found'
            ], 400);
        }
    
        try {
            $itemDetails = [];
            $order = null;
    
            // ================= ALUR 1: RENT NOW =================
            if ($rentalData) {
                $product = Product::findOrFail($rentalData['product_id']);
                $subtotal = $product->price * $rentalData['quantity'] * $rentalData['rental_days'];
                $serviceFee = 5000;
                $deposit = $subtotal * 0.5;
                $shippingCost = $rentalData['delivery_option'] === 'delivery' ? 10000 : 0;
                $total = $subtotal + $serviceFee + $deposit + $shippingCost;
    
                $orderCode = 'FST-' . date('Ymd') . '-' . strtoupper(uniqid());
    
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
    
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $rentalData['quantity'],
                    'unit_price' => $product->price,
                    'subtotal' => $subtotal
                ]);
    
                $itemDetails[] = [
                    'id' => $product->id,
                    'price' => $subtotal, // sudah dikali qty dan hari
                    'quantity' => 1, // biar tidak dikali ulang
                    'name' => $product->name . ' (' . $rentalData['quantity'] . ' pcs × ' . $rentalData['rental_days'] . ' days)'
                ];
            }
    
            // ================= ALUR 2: CHECKOUT DARI CART =================
            if ($orderId && !$rentalData) {
                $order = Order::with('orderProducts.product')->findOrFail($orderId);
                $subtotal = 0;
    
                $rentalDays = \Carbon\Carbon::parse($order->start_date)
                    ->diffInDays(\Carbon\Carbon::parse($order->end_date)) + 1;
    
                foreach ($order->orderProducts as $item) {
                    $productPrice = $item->unit_price;
                    $qty = $item->quantity;
                    $sub = $productPrice * $qty * $rentalDays;
                    $subtotal += $sub;
    
                    $itemDetails[] = [
                        'id' => $item->product_id,
                        'price' => $item->unit_price * $qty * $rentalDays, // Sudah dikali total
                        'quantity' => 1, // biar Midtrans tidak mengalikan ulang
                        'name' => $item->product->name . " ({$qty} pcs × {$rentalDays} days)"
                    ];
                    
                    
                }
    
                $serviceFee = 5000;
                $deposit = $subtotal * 0.5;
                $shippingCost = $order->delivery_option === 'delivery' ? 10000 : 0;
                $total = $subtotal + $serviceFee + $deposit + $shippingCost;
    
                $order->update(['total_amount' => $total]);
            }
    
            // ================= ITEM TAMBAHAN =================
            $itemDetails[] = [
                'id' => 'service_fee',
                'price' => $serviceFee,
                'quantity' => 1,
                'name' => 'Service Fee'
            ];
            $itemDetails[] = [
                'id' => 'deposit',
                'price' => $deposit,
                'quantity' => 1,
                'name' => 'Security Deposit (50%)'
            ];
            if ($shippingCost > 0) {
                $itemDetails[] = [
                    'id' => 'shipping',
                    'price' => $shippingCost,
                    'quantity' => 1,
                    'name' => 'Delivery Fee'
                ];
            }
    
            // ================= MIDTRANS CONFIG =================
            $transactionDetails = [
                'order_id' => $order->order_code,
                'gross_amount' => $order->total_amount
            ];
    
            $customer = auth()->user();
            $customerDetails = [
                'first_name' => $customer->name,
                'last_name' => '',
                'email' => $customer->email,
                'phone' => $customer->phone ?? '081234567890'
            ];
    
            $enabledPayments = match ($request->payment_method) {
                'bank' => ['bank_transfer'],
                'ewallet' => ['gopay', 'shopeepay'],
                default => ['bank_transfer', 'gopay', 'shopeepay'],
            };
    
            $params = [
                'transaction_details' => $transactionDetails,
                'item_details' => $itemDetails,
                'customer_details' => $customerDetails,
                'enabled_payments' => $enabledPayments,
                'callbacks' => [
                    'finish' => route('payment.finish')
                ],
                'expiry' => [
                    'start_time' => now()->format('Y-m-d H:i:s O'),
                    'unit' => 'minutes',
                    'duration' => 60
                ]
            ];
    
            $snapToken = Snap::getSnapToken($params);
    
            return response()->json([
                'success' => true,
                'snap_token' => $snapToken,
                'order_code' => $order->order_code
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment processing failed: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function checkoutFromCart(Request $request)
    {
        $user = auth()->user();
    
        // Validasi dan pecah input ID
        if (!$request->filled('selected_cart_ids')) {
            return redirect()->route('cart')->with('error', 'No items selected for checkout.');
        }
    
        $selectedIds = array_filter(explode(',', $request->input('selected_cart_ids')));
    
        // Ambil item cart sesuai ID dan milik user
        $cartItems = Cart::with('product')
            ->where('user_id', $user->id)
            ->whereIn('id', $selectedIds)
            ->get();
    
        // Validasi jumlah item yang diambil sesuai input
        if ($cartItems->count() !== count($selectedIds)) {
            return redirect()->route('cart')->with('error', 'Some selected cart items are invalid.');
        }
    
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'No valid items selected.');
        }
    
        $subtotal = 0;
        $hasDelivery = false;
        $itemDetails = [];
    
        // Loop item cart untuk hitung harga & data delivery
        foreach ($cartItems as $item) {
            $price = $item->product->price;
            $qty = $item->quantity;
    
            $start = \Carbon\Carbon::parse($item->start_date);
            $end = \Carbon\Carbon::parse($item->end_date);
            $rentalDays = $start->diffInDays($end) + 1;
    
            if ($rentalDays > 7) {
                return redirect()->route('cart')->with('error', 'Item "' . $item->product->name . '" exceeds 7-day rental limit.');
            }
    
            $item->rental_days = $rentalDays;
    
            $itemTotal = $price * $qty * $rentalDays;
            $subtotal += $itemTotal;

            \Log::info('Item perhitungan:', [
                'name' => $item->product->name,
                'price' => $price,
                'qty' => $qty,
                'days' => $rentalDays,
                'total' => $itemTotal,
            ]);
            
            $itemDetails[] = [
                'id' => $item->product->id,
                'price' => (int) $price,
                'quantity' => $qty * $rentalDays,
                'name' => $item->product->name
            ];
            

            // Cek pengiriman
            if ($item->delivery_option === 'delivery') {
                $hasDelivery = true;
    
                if ($item->delivery_details) {
                    $details = json_decode($item->delivery_details, true);
                    $item->recipient_name = $details['recipient_name'] ?? '-';
                    $item->phone_number = $details['phone'] ?? '-';
                    $item->delivery_address = $details['address'] ?? '-';
                }
            }
        }
    
        $serviceFee = 5000;
        $deposit = $subtotal * 0.5;
        $deliveryFee = $hasDelivery ? 10000 : 0;
        $total = $subtotal + $serviceFee + $deposit + $deliveryFee;
    
        // Tambahkan biaya lain ke itemDetails
        $itemDetails[] = ['id' => 'service', 'price' => $serviceFee, 'quantity' => 1, 'name' => 'Service Fee'];
        $itemDetails[] = ['id' => 'deposit', 'price' => $deposit, 'quantity' => 1, 'name' => 'Security Deposit'];
        if ($deliveryFee > 0) {
            $itemDetails[] = ['id' => 'delivery', 'price' => $deliveryFee, 'quantity' => 1, 'name' => 'Delivery Fee'];
        }
    
        // Simpan order
        $orderCode = 'FST-' . date('Ymd') . '-' . strtoupper(uniqid());
        $order = Order::create([
            'user_id' => $user->id,
            'order_code' => $orderCode,
            'total_amount' => $total,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'start_date' => now(),
            'end_date' => now()->addDays(3), // opsional default
        ]);
    
        // Simpan produk dalam order
        foreach ($cartItems as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'unit_price' => $item->product->price,
                'subtotal' => $item->product->price * $item->quantity * $item->rental_days, // ✅ benar
            ]);
        }
    
        // Hapus dari cart setelah checkout (opsional)
        session([
            'current_order_id' => $order->id,
            'cart_ids_to_remove' => $selectedIds
        ]);
    
        // Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderCode,
                'gross_amount' => $total,
            ],
            'item_details' => $itemDetails,
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone ?? '081234567890',
            ],
            'expiry' => [
                'start_time' => now()->format('Y-m-d H:i:s O'),
                'unit' => 'minutes',
                'duration' => 60,
            ]
        ];
    
        $snapToken = Snap::getSnapToken($params);


        $cartItems = $cartItems->map(function ($item) {
            // Pastikan properti product tetap
            $item->product = $item->product;
        
            // Hitung rental_days
            $start = \Carbon\Carbon::parse($item->start_date);
            $end = \Carbon\Carbon::parse($item->end_date);
            $item->rental_days = $start->diffInDays($end) + 1;
        
            // Set delivery details jika delivery
            if ($item->delivery_option === 'delivery' && $item->delivery_details) {
                $details = json_decode($item->delivery_details, true);
                $item->recipient_name = $details['recipient_name'] ?? '-';
                $item->phone_number = $details['phone'] ?? '-';
                $item->delivery_address = $details['address'] ?? '-';
            } else {
                $item->recipient_name = '-';
                $item->phone_number = '-';
                $item->delivery_address = '-';
            }
        
            return $item;
        });
        
    
        return view('pages.customer.paymentcust', [
            'paymentData' => [
                'cart_items' => $cartItems,
                'pricing' => [
                    'subtotal' => $subtotal,
                    'service_fee' => $serviceFee,
                    'deposit' => $deposit,
                    'shipping_cost' => $deliveryFee,
                    'total' => $total,
                ]
            ],
            'items' => $cartItems, // ✅ TAMBAHKAN INI
            'snapToken' => $snapToken,
            'orderCode' => $orderCode,
        ]);
    }

    public function paymentFinish(Request $request)
    {
        $orderId = session('current_order_id');
        $cartIds = session('cart_ids_to_remove', []);
    
        if ($orderId) {
            $order = Order::find($orderId);
            if ($order && $order->payment_status === 'paid') {
                // Hapus cart hanya jika payment sukses
                if (!empty($cartIds)) {
                    Cart::where('user_id', auth()->id())
                        ->whereIn('id', $cartIds)
                        ->delete();
                }
    
                // Hapus session
                session()->forget(['current_order_id', 'cart_ids_to_remove']);
    
                return redirect()->route('order.success', $order->order_code);
            }
        }
    
        return redirect()->route('home')->with('error', 'Payment not completed yet.');
    }
    

    public function paymentNotification(Request $request)
    {
        try {
            // Log incoming notification for debugging
            \Log::info('Midtrans Notification Received:', $request->all());

            $notification = new Notification();
            
            $transactionStatus = $notification->transaction_status;
            $fraudStatus = $notification->fraud_status ?? 'accept'; // Default to accept if not present
            $orderId = $notification->order_id;
            $statusCode = $notification->status_code;
            $grossAmount = $notification->gross_amount;

            // Find order by order_code
            $order = Order::where('order_code', $orderId)->first();
            
            if (!$order) {
                \Log::error('Order not found for order_id: ' . $orderId);
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Verify signature key for security
            $serverKey = config('midtrans.serverKey');
            $expectedSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);
            
            if ($notification->signature_key !== $expectedSignature) {
                \Log::error('Invalid signature key for order: ' . $orderId);
                return response()->json(['message' => 'Invalid signature'], 400);
            }

            \Log::info("Processing notification for order: {$orderId}, status: {$transactionStatus}, fraud: {$fraudStatus}");

            // Handle different transaction statuses
            if ($transactionStatus == 'capture') {
                if ($fraudStatus == 'challenge') {
                    $order->update([
                        'payment_status' => 'partial',
                        'status' => 'pending'
                    ]);
                    \Log::info("Order {$orderId} marked as partial/pending due to fraud challenge");
                } else if ($fraudStatus == 'accept') {
                    $order->update([
                        'payment_status' => 'paid',
                        'status' => 'confirmed'
                    ]);
                    \Log::info("Order {$orderId} marked as paid/confirmed");
                }
            } else if ($transactionStatus == 'settlement') {
                // This is the most common success status for non-card payments
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed'
                ]);
                \Log::info("Order {$orderId} settled - marked as paid/confirmed");
            } else if ($transactionStatus == 'pending') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'pending'
                ]);
                \Log::info("Order {$orderId} is pending payment");
            } else if ($transactionStatus == 'deny') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled'
                ]);
                \Log::info("Order {$orderId} denied - cancelled");
            } else if ($transactionStatus == 'expire') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled'
                ]);
                \Log::info("Order {$orderId} expired - cancelled");
            } else if ($transactionStatus == 'cancel') {
                $order->update([
                    'payment_status' => 'unpaid',
                    'status' => 'cancelled'
                ]);
                \Log::info("Order {$orderId} cancelled");
            }

            return response()->json(['message' => 'Notification handled successfully']);

        } catch (\Exception $e) {
            \Log::error('Midtrans notification error: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }

    }
}