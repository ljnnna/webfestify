<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;




class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        $categories = Category::all();
        return view('admin.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'details' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'required|array|min:1|max:5',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'stock_quantity' => $request->stock_quantity,
        ]);

        // Handle multiple images - TANPA is_primary
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                    // Tidak ada is_primary field
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product added.');
    }

    /**
     * Display the specified resource.
     */
    public function detailBySlug($slug)
    {
        $product = Product::with('images', 'category')->where('slug', $slug)->firstOrFail();
    
        // Ambil path gambar dari relasi
        $productImages = $product->images->pluck('path')->toArray();
    
        return view('pages.customer.detailsproductcatalogcust', compact('product', 'productImages'));
    }
    
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function deleteImage($imageId)
    {
        try {
            // Cari image berdasarkan ID
            $image = ProductImage::findOrFail($imageId);
            
            // Hapus file dari storage
            if (Storage::disk('public')->exists($image->path)) {
                Storage::disk('public')->delete($image->path);
            }
            
            // Hapus record dari database
            $image->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Image deleted successfully'
            ]);
        
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }

    //Method update di ProductController untuk handle multiple images
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'details' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        try {
            $product = Product::findOrFail($id);
            
            // Update product data
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'details' => $request->details,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
            ]);
        
            // Handle new images upload
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $path = $image->store('products', 'public');
                    
                    ProductImage::create([
                        'product_id' => $product->id,
                        'path' => $path,
                    ]);
                }
            }
        
        return redirect()->back()->with('success', 'Product updated successfully!');
        
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
    foreach ($product->images as $img) {
        Storage::disk('public')->delete($img->path);
        $img->delete();
    }

    $product->delete();

    return redirect()->route('admin.product.index')->with('success', 'Product deleted.');
    }


    public function processRentNow(Request $request)
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

    // Validate rental period (max 7 days)
    $startDate = new \Carbon\Carbon($request->start_date);
    $endDate = new \Carbon\Carbon($request->end_date);
    $rentalDays = $startDate->diffInDays($endDate) + 1;
    
    if ($rentalDays > 7) {
        return back()->withErrors(['end_date' => 'Maximum rental period is 7 days'])->withInput();
    }

    // Store rental data in session
    session([
        'rental_data' => [
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rental_days' => $this->calculateDays($request->start_date, $request->end_date),
            'delivery_option' => $request->delivery_option,
            'delivery_address' => $request->delivery_address,
            'phone_number' => $request->phone_number,
            'recipient_name' => $request->recipient_name
        ]
    ]);

    return redirect()->route('payment');
}

private function calculateDays($startDate, $endDate)
{
    $start = new \Carbon\Carbon($startDate);
    $end = new \Carbon\Carbon($endDate);
    return $start->diffInDays($end) + 1;
}




}
