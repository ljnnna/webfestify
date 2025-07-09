<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ReturnProduct;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ReturnProductController extends Controller
{
    /**
     * ========================= ADMIN SECTION =========================
     */

    // Halaman admin untuk melihat semua return dan statistik
// ReturnProductController.php (Admin)
public function index()
{
    // Ambil semua order yang masih aktif DAN produknya belum diproses return
    $activeOrders = Order::with(['orderProducts.product', 'user', 'returnProducts'])
        ->where('status', 'active')
        ->whereHas('orderProducts', function ($q) {
            $q->whereDoesntHave('returnProduct');
        })
        ->orderBy('created_at', 'desc')
        ->get();

    // Ambil semua data return (jika ingin hanya "in_process", tambahkan where)
    $returns = ReturnProduct::with([
        'order', 
        'orderProduct', 
        'product', 
        'user',
        'review',          
        'review.user',     
        'review.product'   
    ])
    ->whereIn('return_status', ['in_process', 'checked', 'collected'])

    ->orderBy('created_at', 'desc')
    ->get();
    

    // Statistik
    $totalProducts = Product::count();
    $productRented = OrderProduct::whereHas('order', function ($q) {
        $q->where('status', 'active');
    })->count();

    $productReturned = ReturnProduct::where('return_status', 'completed')->count();

    return view('admin.returnproduct', compact(
        'activeOrders',
        'returns',
        'totalProducts',
        'productRented',
        'productReturned'
    ));
}

public function uploadCondition(Request $request, $id)
{
    $return = ReturnProduct::findOrFail($id);

    // ❌ Cegah upload ulang jika sudah pernah upload
    if (!empty($return->condition_after)) {
        return back()->with('error', 'Condition photos already uploaded.');
    }

    if ($request->hasFile('condition_after')) {
        $photos = [];

        foreach ($request->file('condition_after') as $file) {
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/conditions', $filename);
            $photos[] = $filename;
        }

        $return->condition_after = json_encode($photos);

        // ✅ Otomatis update status menjadi 'checked'
        if (in_array($return->return_status, ['in_process', 'checked'])) {
            // ✅ Jangan ubah kalau sudah collected atau completed
            if (!in_array($return->return_status, ['collected', 'completed'])) {
                $return->return_status = 'checked';
            }
        }
        
        $return->save();

        return back()->with('success', 'Condition after photos uploaded successfully.');
    }

    return back()->with('error', 'No file uploaded.');
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
    $returnProduct = ReturnProduct::findOrFail($id);

    if ($request->has('condition_notes')) {
        $request->validate([
            'condition_notes' => 'nullable|string|max:500',
        ]);
        $returnProduct->condition_notes = $request->condition_notes;
    }

    if ($request->has('product_condition')) {
        $request->validate([
            'product_condition' => 'nullable|in:excellent,good,fair,poor,damaged',
        ]);
        $returnProduct->product_condition = $request->product_condition;
    }

    if ($request->has('penalty_amount')) {
        $request->validate([
            'penalty_amount' => 'nullable|numeric|min:0',
        ]);
        $returnProduct->penalty_amount = $request->penalty_amount ?? 0;
    }

    // ✅ HANYA ubah ke 'collected' jika sudah 'checked' dan kondisi barang bagus
    if (
        in_array($returnProduct->product_condition, ['good', 'excellent']) &&
        $returnProduct->return_status === 'checked'
    ) {
        // ✅ Jangan timpa kalau sudah completed
        if ($returnProduct->return_status !== 'completed') {
            $returnProduct->return_status = 'collected';
        }
    }
    

    $returnProduct->save();

    return redirect()->back()->with('success', 'Catatan kondisi berhasil diupdate!');
}


    /**
     * ========================= CUSTOMER SECTION =========================
     */

    public function show($id)
    {
        $return = ReturnProduct::findOrFail($id);
        $conditionPhotos = $return->condition_before ?? [];
        return view('profile.rental-detail', compact('return', 'conditionPhotos'));
    }

    public function pickupView($orderId, $orderProductId)
    {
        $order = Order::with(['returnProducts'])->findOrFail($orderId);
    
        $orderProduct = $order->orderProducts->where('id', $orderProductId)->first();
        if (!$orderProduct) {
            abort(404, 'Produk tidak ditemukan dalam order.');
        }
    
        $return = ReturnProduct::where('order_id', $orderId)
            ->where('order_product_id', $orderProductId)
            ->first();
    
        $alreadyReviewed = Review::where('user_id', auth()->id())
            ->where('return_product_id', $return->id)
            ->exists();;
    
        return view('returns.pickup', compact('order', 'orderProduct', 'return', 'alreadyReviewed'));
    }
    
    
    

    public function dropoffItemView($orderId, $orderProductId)
    {
        $order = Order::with(['orderProducts.product'])->findOrFail($orderId);

        $return = ReturnProduct::where('order_id', $order->id)
            ->where('order_product_id', $orderProductId)
            ->with('orderProduct.product', 'penalties', 'review')
            ->firstOrFail();

        $allReturns = ReturnProduct::where('order_id', $order->id)->get();

        $alreadyReviewed = Review::where('user_id', auth()->id())
            ->where('return_product_id', $return->id)
            ->exists();

        return view('returns.dropoff', [
            'order' => $order,
            'return' => $return,
            'allReturns' => $allReturns,
            'alreadyReviewed' => $alreadyReviewed,
        ]);
    }
    
    public function uploadPhotos(Request $request, $orderId)
    {
        $request->validate([
            'condition_photos.*' => 'image|mimes:jpg,jpeg,png|max:5120'
        ]);
    
        $order = Order::with('returnProducts')->findOrFail($orderId);
        $returnProduct = $order->returnProducts()->first();
    
        if (!$returnProduct) {
            return back()->with('error', 'Return product not found.');
        }
    
        $existingPhotos = is_array($returnProduct->customer_condition_photos)
            ? $returnProduct->customer_condition_photos
            : json_decode($returnProduct->customer_condition_photos ?? '[]', true);
    
        $paths = [];
        foreach ($request->file('condition_photos') as $photo) {
            $paths[] = $photo->store('conditions', 'public');
        }
    
        $mergedPhotos = array_unique(array_merge($existingPhotos, $paths));
        $returnProduct->customer_condition_photos = json_encode($mergedPhotos);
    
        // ❌ HAPUS BAGIAN INI
        // if (in_array($returnProduct->return_status, ['in_process', null])) {
        //     $returnProduct->return_status = 'checked';
        // }
    
        $returnProduct->save();
    
        return back()->with('success', 'Photos uploaded successfully.');
    }
    
    
    
    

    public function createReturn(Request $request, $orderId, $orderProductId)
    {
        $order = Order::with('orderProducts')->findOrFail($orderId);

        $orderProduct = $order->orderProducts->where('id', $orderProductId)->first();
        if (!$orderProduct) {
            abort(404, 'Produk tidak ditemukan dalam order ini.');
        }

        $returnMethod = $request->input('return_option', 'pickup');

        ReturnProduct::updateOrCreate(
            [
                'order_id' => $order->id,
                'order_product_id' => $orderProduct->id,
                'product_id' => $orderProduct->product_id,
                'user_id' => $order->user_id,
            ],
            [
                'quantity_returned' => $orderProduct->quantity,
                'return_status' => 'in_process',
                'return_method' => $returnMethod,
                'return_processed_at' => now(),
            ]
        );

        if ($returnMethod === 'pickup') {
            return redirect()->route('return.pickup.view', [
                'order' => $order->id,
                'orderProduct' => $orderProduct->id,
            ]);
        } elseif ($returnMethod === 'dropoff') {
            return redirect()->route('returns.dropoff.item', [
                'order' => $order->id,
                'orderProduct' => $orderProduct->id
            ]);
        } else {
            return redirect()->back()->with('error', 'Invalid return method.');
        }
        
        

        return redirect()->back()->with('error', 'Invalid return method.');
    }

    public function confirmReturn(Request $request, $returnId)
    {
        $returnProduct = ReturnProduct::with('order')->findOrFail($returnId);

        $returnProduct->update([
            'return_status' => 'completed',
            'return_completed_at' => now()
        ]);

        $order = $returnProduct->order;
        $allReturnsCompleted = ReturnProduct::where('order_id', $order->id)
            ->where('return_status', '!=', 'completed')
            ->count() === 0;

        if ($allReturnsCompleted) {
            $order->update(['status' => 'completed']);
        }

        return redirect()->back()->with('success', 'Return berhasil dikonfirmasi!');
    }

    public function submitReview(Request $request, $returnId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $return = ReturnProduct::with(['orderProduct.order', 'product'])->findOrFail($returnId);

        if ($return->orderProduct->order->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $existing = Review::where('user_id', auth()->id())
            ->where('return_product_id', $return->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already submitted a review for this return.');
        }


        Review::create([
            'user_id' => auth()->id(),
            'product_id' => $return->product_id,
            'return_product_id' => $return->id,
            'order_product_id' => $return->order_product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function initiate($orderId, $orderProductId)
    {
        $order = Order::with(['orderProducts.product.images'])->findOrFail($orderId);
        $orderProduct = $order->orderProducts->where('id', $orderProductId)->first();

        if (!$orderProduct) {
            abort(404, 'Produk tidak ditemukan dalam order ini.');
        }

        $existingReturn = ReturnProduct::where('order_id', $orderId)
            ->where('order_product_id', $orderProductId)
            ->first();

        return view('profile.initiate', [
            'order' => $order,
            'orderProduct' => $orderProduct,
            'existingReturn' => $existingReturn,
        ]);
    }

    public function viewHistory(Order $order, OrderProduct $orderProduct)
    {
        $return = ReturnProduct::with(['review'])
            ->where('order_id', $order->id)
            ->where('order_product_id', $orderProduct->id)
            ->first();
    
        return view('returns.history', [
            'order' => $order,
            'orderProduct' => $orderProduct,
            'return' => $return
        ]);
    }
    
    
    
    



}




// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Models\ReturnProduct;
// use App\Models\Order;
// use App\Models\Product;
// use App\Models\OrderProduct;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; -->

// class ReturnProductController extends Controller
// {
//     public function index()
//     {
//         // Orders yang sedang aktif (disewa) dan belum ada return record
//         $activeOrders = Order::with(['orderProducts.product', 'user'])
//             ->where('status', 'active')
//             ->whereDoesntHave('returnProducts')
//             ->orderBy('created_at', 'desc')
//             ->get();

//         // Return products yang sudah dibuat
//         $returns = ReturnProduct::with([
//             'order', 
//             'orderProduct', 
//             'product', 
//             'user'
//         ])->orderBy('created_at', 'desc')->get();

//         // Statistik untuk card
//         $totalProducts = Product::count();
//         $productRented = Order::where('status', 'active')->count();
//         $productReturned = ReturnProduct::where('return_status', 'completed')->count();

//         return view('admin.returnproduct', compact(
//             'activeOrders',
//             'returns', 
//             'totalProducts', 
//             'productRented', 
//             'productReturned'
//         ));
//     }

    

//     public function show($id)
//     {
//     $return = ReturnProduct::findOrFail($id);

//     $conditionPhotos = $return->condition_before ?? [];


//     return view('profile.rental-detail', compact('return', 'conditionPhotos'));
//     }

    
//     public function pickupView($orderId)
//     {
//         $order = Order::with(['orderProducts.product'])->findOrFail($orderId);
//         $return = ReturnProduct::where('order_id', $order->id)->first();
    
//         return view('returns.pickup', compact('order', 'return'));
//     }

//     public function dropoffView($orderId)
//     {
//     $order = Order::with(['orderProducts.product'])->findOrFail($orderId);
//     $returns = ReturnProduct::where('order_id', $order->id)->with('orderProduct')->get();

//     return view('returns.dropoff', compact('order', 'returns'));
//     }
    
    
//     public function uploadPhotos(Request $request, $orderId)
//     {
//         $request->validate([
//             'condition_photos.*' => 'required|image|mimes:jpeg,png,jpg|max:5120',
//         ]);
    
//         $order = Order::with('orderProducts')->findOrFail($orderId);
    
//         // Ambil atau buat data return untuk tiap produk
//         foreach ($order->orderProducts as $orderProduct) {
//             $return = ReturnProduct::firstOrCreate([
//                 'order_id' => $order->id,
//                 'order_product_id' => $orderProduct->id,
//                 'product_id' => $orderProduct->product_id,
//                 'user_id' => $order->user_id,
//             ], [
//                 'quantity_returned' => $orderProduct->quantity,
//                 'return_status' => 'in_process',
//                 'return_method' => 'pickup',
//                 'return_processed_at' => now(),
//             ]);
        
//             // Upload foto ke kolom condition_before (karena dari user)
//             $photoPaths = [];
//             foreach ($request->file('condition_photos') as $file) {
//                 $path = $file->store('return_conditions/before', 'public');
//                 $photoPaths[] = $path;
//             }
        
//             $return->condition_before = $photoPaths;
//             $return->save();
//         }
    
//         return redirect()->back()->with('success', 'Photos uploaded successfully.');
//     }
    
// public function uploadCondition(Request $request, $id)
// {
//     $return = ReturnProduct::findOrFail($id);

//     // Upload condition_before
//     if ($request->hasFile('condition_before')) {
//         $beforePaths = [];

//         foreach ($request->file('condition_before') as $file) {
//             $filename = uniqid() . '.' . $file->getClientOriginalExtension();
//             $file->storeAs('public/conditions', $filename);
//             $beforePaths[] = $filename;
//         }

//         // Simpan sebagai JSON
//         $return->condition_before = json_encode($beforePaths);
//     }

//     // Upload condition_after (sama logikanya)
//     if ($request->hasFile('condition_after')) {
//         $afterPaths = [];

//         foreach ($request->file('condition_after') as $file) {
//             $filename = uniqid() . '.' . $file->getClientOriginalExtension();
//             $file->storeAs('public/conditions', $filename);
//             $afterPaths[] = $filename;
//         }

//         $return->condition_after = json_encode($afterPaths);
//     }

//     $return->save();

//     return back()->with('success', 'Condition photos uploaded successfully.');
// }

//     public function updateStatus(Request $request, $id)
//     {
//         $request->validate([
//             'return_status' => 'required|in:in_process,completed'
//         ]);

//         $returnProduct = ReturnProduct::findOrFail($id);
//         $returnProduct->return_status = $request->return_status;
        
//         if ($request->return_status === 'completed') {
//             $returnProduct->return_completed_at = now();
//         }

//         $returnProduct->save();

//         return redirect()->back()->with('success', 'Status return berhasil diupdate!');
//     }

    // public function updateNotes(Request $request, $id)
    // {
    //     $request->validate([
    //         'condition_notes' => 'nullable|string|max:500',
    //         'product_condition' => 'nullable|in:excellent,good,fair,poor,damaged',
    //         'penalty_amount' => 'nullable|numeric|min:0'
    //     ]);

    //     $returnProduct = ReturnProduct::findOrFail($id);
    //     $returnProduct->condition_notes = $request->condition_notes;
    //     $returnProduct->product_condition = $request->product_condition;
    //     $returnProduct->penalty_amount = $request->penalty_amount ?? 0;
    //     $returnProduct->save();

    //     return redirect()->back()->with('success', 'Catatan kondisi berhasil diupdate!');
    // }

    // public function createReturn(Request $request, $orderId)
    // {
    //     $order = Order::with('orderProducts')->findOrFail($orderId);
    //     $returnMethod = $request->input('return_option', 'pickup'); // default pickup
    
    //     foreach ($order->orderProducts as $orderProduct) {
    //         ReturnProduct::create([
    //             'order_id' => $order->id,
    //             'order_product_id' => $orderProduct->id,
    //             'product_id' => $orderProduct->product_id,
    //             'user_id' => $order->user_id,
    //             'quantity_returned' => $orderProduct->quantity,
    //             'return_status' => 'in_process',
    //             'return_method' => $returnMethod,
    //             'return_processed_at' => now(),
    //         ]);
    //     }
    
    //     // Redirect ke halaman berbeda sesuai pilihan
    //     if ($returnMethod === 'pickup') {
    //         return redirect()->route('return.pickup.view', ['order' => $order->id]);
    //     } elseif ($returnMethod === 'dropoff') {
    //         return redirect()->route('return.dropoff.view', ['order' => $order->id]);
    //     }
    
    //     // fallback kalau return_option tidak valid
    //     return redirect()->back()->with('error', 'Invalid return method.');
    // }



//     public function confirmReturn(Request $request, $returnId)
//     {
//         $returnProduct = ReturnProduct::with('order')->findOrFail($returnId);
        
//         // Update status return menjadi completed
//         $returnProduct->update([
//             'return_status' => 'completed',
//             'return_completed_at' => now()
//         ]);

//         // Cek apakah semua product dalam order sudah completed
//         $order = $returnProduct->order;
//         $allReturnsCompleted = ReturnProduct::where('order_id', $order->id)
//             ->where('return_status', '!=', 'completed')
//             ->count() === 0;

//         // Jika semua return completed, ubah status order menjadi completed
//         if ($allReturnsCompleted) {
//             $order->update(['status' => 'completed']);
//         }

//         return redirect()->back()->with('success', 'Return berhasil dikonfirmasi!');
//     }

    


// }




// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use App\Models\ReturnProduct;
// use App\Models\Order;
// use App\Models\Product;
// use App\Models\OrderProduct;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage; -->

// class ReturnProductController extends Controller
// {
//     public function index()
//     {
//         // Orders yang sedang aktif (disewa) dan belum ada return record
//         $activeOrders = Order::with(['orderProducts.product', 'user'])
//             ->where('status', 'active')
//             ->whereDoesntHave('returnProducts')
//             ->orderBy('created_at', 'desc')
//             ->get();

//         // Return products yang sudah dibuat
//         $returns = ReturnProduct::with([
//             'order', 
//             'orderProduct', 
//             'product', 
//             'user'
//         ])->orderBy('created_at', 'desc')->get();

//         // Statistik untuk card
//         $totalProducts = Product::count();
//         $productRented = Order::where('status', 'active')->count();
//         $productReturned = ReturnProduct::where('return_status', 'completed')->count();

//         return view('admin.returnproduct', compact(
//             'activeOrders',
//             'returns', 
//             'totalProducts', 
//             'productRented', 
//             'productReturned'
//         ));
//     }

    

//     public function show($id)
//     {
//     $return = ReturnProduct::findOrFail($id);

//     $conditionPhotos = $return->condition_before ?? [];


//     return view('profile.rental-detail', compact('return', 'conditionPhotos'));
//     }

    
//     public function pickupView($orderId)
//     {
//         $order = Order::with(['orderProducts.product'])->findOrFail($orderId);
//         $return = ReturnProduct::where('order_id', $order->id)->first();
    
//         return view('returns.pickup', compact('order', 'return'));
//     }

//     public function dropoffView($orderId)
//     {
//     $order = Order::with(['orderProducts.product'])->findOrFail($orderId);
//     $returns = ReturnProduct::where('order_id', $order->id)->with('orderProduct')->get();

//     return view('returns.dropoff', compact('order', 'returns'));
//     }
    
    
//     public function uploadPhotos(Request $request, $orderId)
//     {
//         $request->validate([
//             'condition_photos.*' => 'required|image|mimes:jpeg,png,jpg|max:5120',
//         ]);
    
//         $order = Order::with('orderProducts')->findOrFail($orderId);
    
//         // Ambil atau buat data return untuk tiap produk
//         foreach ($order->orderProducts as $orderProduct) {
//             $return = ReturnProduct::firstOrCreate([
//                 'order_id' => $order->id,
//                 'order_product_id' => $orderProduct->id,
//                 'product_id' => $orderProduct->product_id,
//                 'user_id' => $order->user_id,
//             ], [
//                 'quantity_returned' => $orderProduct->quantity,
//                 'return_status' => 'in_process',
//                 'return_method' => 'pickup',
//                 'return_processed_at' => now(),
//             ]);
        
//             // Upload foto ke kolom condition_before (karena dari user)
//             $photoPaths = [];
//             foreach ($request->file('condition_photos') as $file) {
//                 $path = $file->store('return_conditions/before', 'public');
//                 $photoPaths[] = $path;
//             }
        
//             $return->condition_before = $photoPaths;
//             $return->save();
//         }
    
//         return redirect()->back()->with('success', 'Photos uploaded successfully.');
//     }
    
// public function uploadCondition(Request $request, $id)
// {
//     $return = ReturnProduct::findOrFail($id);

//     // Upload condition_before
//     if ($request->hasFile('condition_before')) {
//         $beforePaths = [];

//         foreach ($request->file('condition_before') as $file) {
//             $filename = uniqid() . '.' . $file->getClientOriginalExtension();
//             $file->storeAs('public/conditions', $filename);
//             $beforePaths[] = $filename;
//         }

//         // Simpan sebagai JSON
//         $return->condition_before = json_encode($beforePaths);
//     }

//     // Upload condition_after (sama logikanya)
//     if ($request->hasFile('condition_after')) {
//         $afterPaths = [];

//         foreach ($request->file('condition_after') as $file) {
//             $filename = uniqid() . '.' . $file->getClientOriginalExtension();
//             $file->storeAs('public/conditions', $filename);
//             $afterPaths[] = $filename;
//         }

//         $return->condition_after = json_encode($afterPaths);
//     }

//     $return->save();

//     return back()->with('success', 'Condition photos uploaded successfully.');
// }

//     public function updateStatus(Request $request, $id)
//     {
//         $request->validate([
//             'return_status' => 'required|in:in_process,completed'
//         ]);

//         $returnProduct = ReturnProduct::findOrFail($id);
//         $returnProduct->return_status = $request->return_status;
        
//         if ($request->return_status === 'completed') {
//             $returnProduct->return_completed_at = now();
//         }

//         $returnProduct->save();

//         return redirect()->back()->with('success', 'Status return berhasil diupdate!');
//     }

    // public function updateNotes(Request $request, $id)
    // {
    //     $request->validate([
    //         'condition_notes' => 'nullable|string|max:500',
    //         'product_condition' => 'nullable|in:excellent,good,fair,poor,damaged',
    //         'penalty_amount' => 'nullable|numeric|min:0'
    //     ]);

    //     $returnProduct = ReturnProduct::findOrFail($id);
    //     $returnProduct->condition_notes = $request->condition_notes;
    //     $returnProduct->product_condition = $request->product_condition;
    //     $returnProduct->penalty_amount = $request->penalty_amount ?? 0;
    //     $returnProduct->save();

    //     return redirect()->back()->with('success', 'Catatan kondisi berhasil diupdate!');
    // }

    // public function createReturn(Request $request, $orderId)
    // {
    //     $order = Order::with('orderProducts')->findOrFail($orderId);
    //     $returnMethod = $request->input('return_option', 'pickup'); // default pickup
    
    //     foreach ($order->orderProducts as $orderProduct) {
    //         ReturnProduct::create([
    //             'order_id' => $order->id,
    //             'order_product_id' => $orderProduct->id,
    //             'product_id' => $orderProduct->product_id,
    //             'user_id' => $order->user_id,
    //             'quantity_returned' => $orderProduct->quantity,
    //             'return_status' => 'in_process',
    //             'return_method' => $returnMethod,
    //             'return_processed_at' => now(),
    //         ]);
    //     }
    
    //     // Redirect ke halaman berbeda sesuai pilihan
    //     if ($returnMethod === 'pickup') {
    //         return redirect()->route('return.pickup.view', ['order' => $order->id]);
    //     } elseif ($returnMethod === 'dropoff') {
    //         return redirect()->route('return.dropoff.view', ['order' => $order->id]);
    //     }
    
    //     // fallback kalau return_option tidak valid
    //     return redirect()->back()->with('error', 'Invalid return method.');
    // }



//     public function confirmReturn(Request $request, $returnId)
//     {
//         $returnProduct = ReturnProduct::with('order')->findOrFail($returnId);
        
//         // Update status return menjadi completed
//         $returnProduct->update([
//             'return_status' => 'completed',
//             'return_completed_at' => now()
//         ]);

//         // Cek apakah semua product dalam order sudah completed
//         $order = $returnProduct->order;
//         $allReturnsCompleted = ReturnProduct::where('order_id', $order->id)
//             ->where('return_status', '!=', 'completed')
//             ->count() === 0;

//         // Jika semua return completed, ubah status order menjadi completed
//         if ($allReturnsCompleted) {
//             $order->update(['status' => 'completed']);
//         }

//         return redirect()->back()->with('success', 'Return berhasil dikonfirmasi!');
//     }

    


// }