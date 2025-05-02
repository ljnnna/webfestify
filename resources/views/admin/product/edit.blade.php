@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <h1 class="text-2xl font-bold text-[#493862] mb-4">Edit Product</h1>

    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-purple-700">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full border rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-purple-700">Rental Price</label>
            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-purple-700">Description</label>
            <input type="text" name="description" value="{{ old('description', $product->description) }}" class="w-full border rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-purple-700">Details</label>
            <input type="text" name="details" value="{{ old('details', $product->details) }}" class="w-full border rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-purple-700">Stock</label>
            <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="w-full border rounded px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-purple-700">New Image (Opsional)</label>
            <input type="file" name="images[]" multiple class="w-full border rounded px-4 py-2" accept="image/*">
        </div>

        <div class="mb-4">
            <p class="text-purple-700">Old Image:</p>
            <div class="flex gap-2">
                @foreach (json_decode($product->images ?? '[]') as $image)
                    <img src="{{ asset('storage/' . $image) }}" class="h-20 rounded border">
                @endforeach
            </div>
        </div>

        <div class="flex justify-between items-center mt-6">
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
                Save Changes
            </button>

            <!-- Tombol Hapus -->
            <form action="{{ route('product.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Hapus Produk</button>
            </form>
        </div>
    </form>
@endsection
