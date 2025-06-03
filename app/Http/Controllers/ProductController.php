<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        $categories = Category::all(); // ambil semua kategori
        return view('admin.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
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
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Simpan gambar ke storage
    $path = $request->file('image')->store('products', 'public');
        
        //$imagePaths = [];

        // if ($request->hasFile('images')) {
        //     foreach ($request->file('images') as $image) {
        //         $path = $image->store('products', 'public');
        //         $imagePaths[] = $path;
        //     }
        // }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'stock_quantity' => $request->stock_quantity,
            'image' => $path, // Simpan 'products/nama-file.jpg'
        ]);

        return redirect()->route('admin.product.index')->with('success', 'Product added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $products = Product::with('images')->get();
        $categories = Category::all(); // ambil semua kategori
        return view('admin.product.index', compact('products','product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'details' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);
    
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'stock_quantity' => $request->stock_quantity,
        ]);

        if ($request->hasFile('images')) {
        // Hapus gambar lama (opsional)
        foreach ($product->images as $img) {
            \Storage::disk('public')->delete($img->path);
            $img->delete();
        }

        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path' => $path,
            ]);
        }
        }
    
        return redirect()->route('admin.product.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted.');
    }
}
