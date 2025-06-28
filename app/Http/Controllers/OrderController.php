<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrdersData()
    {
        $totalOrders = Order::count();
        $completedOrders = Order::where('status', 'completed')->count();
        $onProgressOrders = Order::where('status', ['pending', 'confirmed', 'active'])->count(); // asumsi: 'Pending' == On Progress
        $canceledOrders = Order::where('status', 'cancelled')->count();

        $orders = Order::with(['user', 'orderProducts.product'])
                       ->orderBy('created_at', 'desc')
                       ->get();

        return [
            'totalOrders' => $totalOrders,
            'completedOrders' => $completedOrders,
            'onProgressOrders' => $onProgressOrders,
            'canceledOrders' => $canceledOrders,
            'orders' => $orders,
        ];
    }

    public function index()
    {
        $data = self::getOrdersData();
        return view('admin.orders', $data);
    }

    public function show($id)
    {
        $order = Order::with(['user', 'orderProducts.product'])->findOrFail($id);
        
        return view('admin.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Validasi overlap
        if (!Order::isDateRangeAvailable($request->start_date, $request->end_date)) {
            return back()->withErrors([
                'date_range' => 'Tanggal yang dipilih sudah ada booking lain. Silakan pilih tanggal lain.'
            ])->withInput();
        }

        // Create order
        $order = Order::create([
            'user_id' => $request->user_id,
            'order_code' => 'ORD-' . time() . '-' . rand(1000, 9999),
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'notes' => $request->notes,
            'order_date' => now()
        ]);

        $totalAmount = 0;

        // Create order items
        foreach ($request->products as $productData) {
            $product = Product::find($productData['product_id']);
            $quantity = $productData['quantity'];
            $unitPrice = $product->price;
            $subtotal = $quantity * $unitPrice;

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'subtotal' => $subtotal,
            ]);

            $totalAmount += $subtotal;
        }

        // Update total amount
        $order->update(['total_amount' => $totalAmount]);

        return redirect()->route('orders.index')->with('success', 'Order berhasil dibuat');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Validasi overlap (exclude order yang sedang diupdate)
        if (!Order::isDateRangeAvailable($request->start_date, $request->end_date, $id)) {
            return back()->withErrors([
                'date_range' => 'Tanggal yang dipilih sudah ada booking lain.'
            ])->withInput();
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,active,completed,canceled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status order berhasil diupdate');
    }

}