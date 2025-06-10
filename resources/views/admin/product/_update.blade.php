<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

<div class="flex gap-8 mb-3">
    <!-- Upload beberapa gambar -->
    <div class="w-48 h-64 bg-purple-200 rounded-2xl items-center justify-center">
        <label class="text-purple-700 font-semibold">Update Product Images (optional)</label>
        <input
            type="file"
            name="images[]"
            multiple
            accept="image/*"
            class="w-full border rounded px-4 py-2"
        >
        <div class="mt-2">
            <p class="text-sm text-gray-500 mb-2">Current Images:</p>
            <div class="flex flex-wrap gap-2">
                @foreach ($product->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image" class="w-20 h-20 object-cover border rounded">
                @endforeach
            </div>
        </div>
    </div>

    <!-- Pilih kategori  -->
    <div class="flex-1 space-y-3">
        <div>
            <label for="category_id" class="block text-purple-700 font-semibold mb-2">Category</label>
            <select name="category_id" id="category_id" class="w-full border rounded-lg px-4 py-2">
                <option value="" disabled selected>-- Choose Category --</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Input nama product  -->
         <div>
            <label class="block text-purple-700 font-semibold mb-2">Product Name</label>
            <input type="text" name="name" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('name', $product->name) }}" required>
        </div>

        <!-- Input harga product  -->
        <div>
            <label class="block text-purple-700 font-semibold mb-2">Rental Price</label>
            <input type="number" name="price" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('price', $product->price) }}" required>
        </div>
    </div>
</div>

    <!-- Input description product  -->
    <div class="mb-4">
        <label class="block text-purple-700 font-semibold mb-2">Description</label>
        <input type="text" name="description" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('description', $product->description) }}" required>
    </div>

    <!-- Input details rental product  -->
    <div class="mb-4">
        <label class="block text-purple-700 font-semibold mb-2">Details</label>
        <input type="text" name="details" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('details', $product->details) }}" required>
    </div>

    <!-- Input jumlah ketersediaan product  -->
    <div class="mb-4">
        <label class="block text-purple-700 font-semibold mb-2">Available Amount</label>
        <input type="number" name="stock_quantity" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0">
    </div>

    <button type="submit" class="bg-[#C8A8E7] text-[#493862] font-semibold px-4 py-2 rounded-full hover:bg-purple-600">
        Update Product
    </button>
</form>