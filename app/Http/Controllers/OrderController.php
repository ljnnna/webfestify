<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



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

        // Validasi stock tersedia
        foreach ($request->products as $productData) {
            $product = Product::find($productData['product_id']);
            $availableStock = $product->stock_quantity - $product->stock_rented;
            
            if ($availableStock < $productData['quantity']) {
                return back()->withErrors([
                    'stock' => "Stock {$product->name} tidak mencukupi. Tersedia: {$availableStock}"
                ])->withInput();
            }
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

            // Update stock
            $product->increment('stock_rented', $quantity);

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
        'status' => 'required|in:pending,confirmed,active,completed,cancelled'
    ]);

    $order = Order::findOrFail($id);
    $oldStatus = $order->status;
    $newStatus = $request->status;

    Log::info("Updating order status", [
        'order_id' => $id,
        'old_status' => $oldStatus,
        'new_status' => $newStatus
    ]);

    // Kembalikan stock jika order completed atau cancelled
    if (in_array($newStatus, ['completed', 'cancelled']) && !in_array($oldStatus, ['completed', 'cancelled'])) {
        foreach ($order->orderProducts as $orderProduct) {
            $product = $orderProduct->product;
            $product->decrement('stock_rented', $orderProduct->quantity);
        }
    }

    // Tambahkan kembali stock jika keluar dari completed/cancelled
    if (!in_array($newStatus, ['completed', 'cancelled']) && in_array($oldStatus, ['completed', 'cancelled'])) {
        foreach ($order->orderProducts as $orderProduct) {
            $product = $orderProduct->product;
            $product->increment('stock_rented', $orderProduct->quantity);
        }
    }

    // Jika status jadi 'confirmed' dan payment masih 'unpaid', ubah jadi 'paid'
    if ($newStatus === 'confirmed' && $order->payment_status === 'unpaid') {
        $order->update([
            'status' => $newStatus,
            'payment_status' => 'paid'
        ]);
    } else {
        $order->update(['status' => $newStatus]);
    }

    Log::info("Order status updated", [
        'order_id' => $id,
        'final_status' => $order->fresh()->status,
        'final_payment_status' => $order->fresh()->payment_status
    ]);

    return redirect()->back()->with('success', 'Status order berhasil diupdate');
}


    public function cancel(Request $request, Order $order)
    {
        // Hanya user yang memiliki order ini yang bisa cancel
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        // ❌ Cegah cancel jika bukan status 'pending'
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order hanya bisa dibatalkan jika masih pending.');
        }
    
        // Update status menjadi cancelled
        $order->status = 'cancelled';
        $order->save();
    
        // Kembalikan stok yang sudah dicatat saat pemesanan
        foreach ($order->orderProducts as $orderProduct) {
            $orderProduct->product->decrement('stock_rented', $orderProduct->quantity);
        }
    
        return back()->with('success', 'Order berhasil dibatalkan.');
    }

    public function tracking()
    {
        $orders = Order::with(['user', 'orderProducts.product'])
            ->where('status', 'confirmed')
            ->where(function ($query) {
                $query->where('delivery_option', 'delivery')
                      ->orWhere(function ($query) {
                          $query->where('delivery_option', 'pickup')
                                ->whereNotNull('pickup_confirmed_at');
                      });
            })
            ->orderBy('created_at', 'desc')
            ->get();
    
        return view('admin.tracking', compact('orders'));
    }
    
    
    public function updateDeliveryStatus(Request $request, Order $order)
    {
        $request->validate([
            'delivery_status' => 'required|in:confirmed,preparing,ready_to_ship,in_delivery,delivered',
        ]);
        
    
        $order->delivery_status = $request->delivery_status;
        $order->save();
    
        return redirect()->back()->with('success', 'Delivery status updated.');
    }
    
    public function customerTracking($orderId)
    {
        $order = Order::with(['products.images', 'products.category'])
            ->where('id', $orderId)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    
        return view('profile.tracking', [
            'order' => $order,
            'trackingStatus' => $order->delivery_status ?? 'order_confirmed',
        ]);
    }
    
    public function track($id)
    {
        $order = Order::with(['products.images', 'products.category'])
            ->where('id', $id)
            ->where('user_id', auth()->id()) // Tambahkan ini agar hanya user yg punya order bisa akses
            ->firstOrFail();
    
        return view('profile.order-tracking', [
            'order' => $order,
            'trackingStatus' => $order->delivery_status ?? 'order_confirmed',
        ]);
    }

    public function confirmPickup(Order $order)
{
    // Cek apakah order milik user yang sedang login (opsional, untuk keamanan)
    if (auth()->id() !== $order->user_id) {
        abort(403, 'Unauthorized action.');
    }

    // Simpan waktu konfirmasi
    $order->pickup_confirmed_at = now();
    $order->save();

    return redirect()->back()->with('success', 'Penjemputan telah dikonfirmasi. Harap ambil barang dalam 5 jam.');
}
    
    
    
    

    


    

}