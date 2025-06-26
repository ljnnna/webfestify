<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->get();
        $categories = Category::all();
        return view('admin.product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

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
            'image.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'max_rent_duration' => 'required|integer|min:1|max:30'
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . uniqid(),
            'price' => $request->price,
            'description' => $request->description,
            'details' => $request->details,
            'stock_quantity' => $request->stock_quantity,
            'available_from' => now(),
            'max_rent_duration' => (int) $request->max_rent_duration,
        ]);

        // Simpan gambar-gambar
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('admin.product.index')->with('success', 'Product added.');
    }

    public function detailBySlug($slug)
    {
        $product = Product::with('images', 'category')->where('slug', $slug)->firstOrFail();
        $productImages = $product->images->pluck('path')->toArray();
        return view('pages.customer.detailsproductcatalogcust', compact('product', 'productImages'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product->load('images');
        return view('admin.product.edit', compact('product', 'categories'));
    }

    public function deleteImage(Product $product, $imageId)
    {
        try {
            // Cari image berdasarkan ID hanya dalam relasi milik product ini
            $image = $product->images()->findOrFail($imageId);

            // Hapus dari storage jika file-nya ada
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
            Log::error('Failed to delete image:', [
                'error' => $e->getMessage(),
                'product_id' => $product->id,
                'image_id' => $imageId
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete image: ' . $e->getMessage()
            ], 500);
        }
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'details' => 'required|string',
            'stock_quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'max_rent_duration' => 'required|integer|min:1|max:30'
        ]);

        try {
            $product = Product::with('images')->findOrFail($id);

            // Cek jumlah total gambar
            $existingImageCount = $product->images->count();
            $newImageCount = count($request->file('images') ?? []);
            if ($existingImageCount + $newImageCount > 5) {
                return redirect()->back()->withErrors(['images' => 'Total images cannot exceed 5'])->withInput();
            }

            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'details' => $request->details,
                'stock_quantity' => $request->stock_quantity,
                'category_id' => $request->category_id,
                'max_rent_duration' => (int) $request->max_rent_duration,
            ]);

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

    public function destroy(Product $product)
    {
        foreach ($product->images as $img) {
            if (Storage::disk('public')->exists($img->path)) {
                Storage::disk('public')->delete($img->path);
            }
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

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $rentalDays = $startDate->diffInDays($endDate) + 1;

        $product = Product::findOrFail($request->product_id);

        if ($request->quantity > $product->stock_quantity) {
            return back()->withErrors([
                'quantity' => 'Requested quantity exceeds available stock (' . $product->stock_quantity . ')'
            ])->withInput();
        }

        if ($rentalDays > $product->max_rent_duration) {
            return back()->withErrors(['end_date' => 'Maximum rental period for this product is ' . $product->max_rent_duration . ' days'])->withInput();
        }

        session([
            'rental_data' => [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'rental_days' => $rentalDays,
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
        $start = new Carbon($startDate);
        $end = new Carbon($endDate);
        return $start->diffInDays($end) + 1;
    }
}
