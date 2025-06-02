<form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Pilih kategori  -->
    <div class="mb-4">
        <label for="category_id" class="block font-semibold mb-1">Category</label>
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
    <div class="mb-4">
        <label class="block text-purple-700">Product Name</label>
        <input type="text" name="name" class="w-full border rounded px-4 py-2" value="{{ old('name', $product->name) }}" required>
    </div>

    <!-- Input harga product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Rental Price</label>
        <input type="number" name="price" class="w-full border rounded px-4 py-2" value="{{ old('price', $product->price) }}" required>
    </div>

    <!-- Input description product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Description</label>
        <input type="text" name="description" class="w-full border rounded px-4 py-2" value="{{ old('description', $product->description) }}" required>
    </div>

    <!-- Input details rental product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Details</label>
        <input type="text" name="details" class="w-full border rounded px-4 py-2" value="{{ old('details', $product->details) }}" required>
    </div>

    <!-- Input jumlah ketersediaan product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Available Amount</label>
        <input type="number" name="stock_quantity" class="w-full border rounded px-4 py-2" value="{{ old('stock_quantity', $product->stock_quantity) }}" required min="0">
    </div>

    <!-- Upload beberapa gambar -->
    <div class="mb-4">
        <label class="block text-purple-700">Update Product Images (optional)</label>
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

    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
        Update Product
    </button>
</form>
