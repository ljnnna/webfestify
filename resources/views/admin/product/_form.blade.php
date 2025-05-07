<form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Upload beberapa gambar -->
    <div class="mb-4">
        <label class="block text-purple-700">Product Images</label>
        <input
            type="file"
            name="images[]"
            multiple
            accept="image/*"
            class="w-full border rounded px-4 py-2"
        >
    </div>
    
    <!-- Pilih kategori  -->
    <div class="mb-4">
        <label for="category_id" class="block font-semibold mb-1">Category</label>
        <select name="category_id" id="category_id" class="w-full border rounded-lg px-4 py-2">
            <option value="">-- Choose Category --</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>


    <!-- Input nama product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Product Name</label>
        <input type="text" name="name" class="w-full border rounded px-4 py-2" required>
    </div>

    <!-- Input harga product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Rental Price</label>
        <input type="number" name="price" class="w-full border rounded px-4 py-2" required>
    </div>

    <!-- Input description product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Description</label>
        <input type="text" name="description" class="w-full border rounded px-4 py-2" required>
    </div>

    <!-- Input details rental product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Details</label>
        <input type="text" name="details" class="w-full border rounded px-4 py-2" required>
    </div>

    <!-- Input jumlah ketersediaan product  -->
    <div class="mb-4">
        <label class="block text-purple-700">Available Amount</label>
        <input type="number" name="stock_quantity" class="w-full border rounded px-4 py-2" required min="0">
    </div>

    <!-- Tambahkan input warna, spesifikasi, gambar, dll sesuai kebutuhan -->
    <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">
        Add Product
    </button>
</form>
