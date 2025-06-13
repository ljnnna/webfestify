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
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'details' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|array|max:5',
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'stock_quantity' => $request->stock_quantity,
        ]);

        // Handle new images if uploaded
        if ($request->hasFile('image')) {
            // Delete old images
            foreach ($product->images as $img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }

            // Add new images - TANPA is_primary
            foreach ($request->file('image') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
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



}
