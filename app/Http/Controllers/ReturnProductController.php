<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReturnProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReturnProductController extends Controller
{
    public function index()
    {
        // Orders yang sedang aktif (disewa) dan belum ada return record
        $activeOrders = Order::with(['orderProducts.product', 'user'])
            ->where('status', 'active')
            ->whereDoesntHave('returnProducts')
            ->orderBy('created_at', 'desc')
            ->get();

        // Return products yang sudah dibuat
        $returns = ReturnProduct::with([
            'order', 
            'orderProduct', 
            'product', 
            'user'
        ])->orderBy('created_at', 'desc')->get();

        // Statistik untuk card
        $totalProducts = Product::count();
        $productRented = Order::where('status', 'active')->count();
        $productReturned = ReturnProduct::where('return_status', 'completed')->count();

        return view('admin.returnproduct', compact(
            'activeOrders',
            'returns', 
            'totalProducts', 
            'productRented', 
            'productReturned'
        ));
    }

public function show($id)
{
    $return = ReturnProduct::findOrFail($id);

    $conditionPhotos = $return->condition_before ?? [];


    return view('profile.rental-detail', compact('return', 'conditionPhotos'));
}
    
    public function pickupView($orderId)
    {
        $order = Order::with(['orderProducts.product'])->findOrFail($orderId);
        $return = ReturnProduct::where('order_id', $order->id)->first();
    
        return view('returns.pickup', compact('order', 'return'));
    }
    
    
    public function uploadPhotos(Request $request, $orderId)
    {
        $request->validate([
            'condition_photos.*' => 'required|image|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        $order = Order::with('orderProducts')->findOrFail($orderId);
    
        // Ambil atau buat data return untuk tiap produk
        foreach ($order->orderProducts as $orderProduct) {
            $return = ReturnProduct::firstOrCreate([
                'order_id' => $order->id,
                'order_product_id' => $orderProduct->id,
                'product_id' => $orderProduct->product_id,
                'user_id' => $order->user_id,
            ], [
                'quantity_returned' => $orderProduct->quantity,
                'return_status' => 'in_process',
                'return_method' => 'pickup',
                'return_processed_at' => now(),
            ]);
        
            // Upload foto ke kolom condition_before (karena dari user)
            $photoPaths = [];
            foreach ($request->file('condition_photos') as $file) {
                $path = $file->store('return_conditions/before', 'public');
                $photoPaths[] = $path;
            }
        
            $return->condition_before = $photoPaths;
            $return->save();
        }
    
        return redirect()->back()->with('success', 'Photos uploaded successfully.');
    }
    
public function uploadCondition(Request $request, $id)
{
    $return = ReturnProduct::findOrFail($id);

    // Upload condition_before
    if ($request->hasFile('condition_before')) {
        $beforePaths = [];

        foreach ($request->file('condition_before') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/conditions', $filename);
            $beforePaths[] = $filename;
        }

        // Simpan sebagai JSON
        $return->condition_before = json_encode($beforePaths);
    }

    // Upload condition_after (sama logikanya)
    if ($request->hasFile('condition_after')) {
        $afterPaths = [];

        foreach ($request->file('condition_after') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/conditions', $filename);
            $afterPaths[] = $filename;
        }

        $return->condition_after = json_encode($afterPaths);
    }

    $return->save();

    return back()->with('success', 'Condition photos uploaded successfully.');
}

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'return_status' => 'required|in:in_process,completed'
        ]);

        $returnProduct = ReturnProduct::findOrFail($id);
        $returnProduct->return_status = $request->return_status;
        
        if ($request->return_status === 'completed') {
            $returnProduct->return_completed_at = now();
        }

        $returnProduct->save();

        return redirect()->back()->with('success', 'Status return berhasil diupdate!');
    }

    public function updateNotes(Request $request, $id)
    {
        $request->validate([
            'condition_notes' => 'nullable|string|max:500',
            'product_condition' => 'nullable|in:excellent,good,fair,poor,damaged',
            'penalty_amount' => 'nullable|numeric|min:0'
        ]);

        $returnProduct = ReturnProduct::findOrFail($id);
        $returnProduct->condition_notes = $request->condition_notes;
        $returnProduct->product_condition = $request->product_condition;
        $returnProduct->penalty_amount = $request->penalty_amount ?? 0;
        $returnProduct->save();

        return redirect()->back()->with('success', 'Catatan kondisi berhasil diupdate!');
    }

    public function createReturn(Request $request, $orderId)
    {
        $order = Order::with('orderProducts')->findOrFail($orderId);
        $returnMethod = $request->input('return_option', 'pickup'); // default pickup
    
        foreach ($order->orderProducts as $orderProduct) {
            ReturnProduct::create([
                'order_id' => $order->id,
                'order_product_id' => $orderProduct->id,
                'product_id' => $orderProduct->product_id,
                'user_id' => $order->user_id,
                'quantity_returned' => $orderProduct->quantity,
                'return_status' => 'in_process',
                'return_method' => $returnMethod,
                'return_processed_at' => now(),
            ]);
        }
    
        // Redirect ke halaman berbeda sesuai pilihan
        if ($returnMethod === 'pickup') {
            return redirect()->route('return.pickup.view', ['order' => $order->id]);
        } elseif ($returnMethod === 'dropoff') {
            return redirect()->route('return.dropoff.view', ['order' => $order->id]);
        }
    
        // fallback kalau return_option tidak valid
        return redirect()->back()->with('error', 'Invalid return method.');
    }



    public function confirmReturn(Request $request, $returnId)
    {
        $returnProduct = ReturnProduct::with('order')->findOrFail($returnId);
        
        // Update status return menjadi completed
        $returnProduct->update([
            'return_status' => 'completed',
            'return_completed_at' => now()
        ]);

        // Cek apakah semua product dalam order sudah completed
        $order = $returnProduct->order;
        $allReturnsCompleted = ReturnProduct::where('order_id', $order->id)
            ->where('return_status', '!=', 'completed')
            ->count() === 0;

        // Jika semua return completed, ubah status order menjadi completed
        if ($allReturnsCompleted) {
            $order->update(['status' => 'completed']);
        }

        return redirect()->back()->with('success', 'Return berhasil dikonfirmasi!');
    }


}