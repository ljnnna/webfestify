<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

<div class="flex m-4">
    <p class="text-[#493862] font-bold justify-center">ADD NEW PRODUCT</p>
</div>    
<div class="flex gap-8 mb-3">
    <!-- <div class="flex space-y-3"> -->
    <!-- Upload beberapa gambar -->
    <div class="w-48 h-64 bg-purple-200 rounded-2xl items-center justify-center">
        <label class="text-purple-700 font-semibold">Product Images</label>
        <input
            type="file"
            name="image"
            multiple
            accept="image/*"
            class="w-full h-full text-gray-600"
        >
    </div>
    <!-- </div> -->
    
    <div class="flex-1 space-y-3">
    <!-- Pilih kategori  -->
    <div>
        <label for="category_id" class="block text-purple-700 font-semibold mb-2">Category</label>
        <select name="category_id" id="category_id" class="w-full border rounded-lg px-4 py-2">
            <option value="">-- Choose Category --</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>


    <!-- Input nama product  -->
    <div>
        <label class="block text-purple-700 font-semibold mb-2">Product Name</label>
        <input type="text" placeholder="add product name..." name="name" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
    </div>

    <!-- Input harga product  -->
    <div>
        <label class="block text-purple-700 font-semibold mb-2">Rental Price</label>
        <input type="number" placeholder="e.x 75000" name="price" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
    </div>
    </div>
</div>

    <!-- Input description product  -->
    <div class="mb-4">
        <label class="block text-purple-700 font-semibold mb-2">Description</label>
        <input type="text" name="description" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
    </div>

    <!-- Input details rental product  -->
    <div class="mb-4">
        <label class="block text-purple-700 font-semibold mb-2">Details</label>
        <input type="text" name="details" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required>
    </div>

    <!-- Input jumlah ketersediaan product  -->
    <div class="mb-4">
        <label class="block text-purple-700 font-semibold mb-2">Available Amount</label>
        <input type="number" name="stock_quantity" class="w-full bg-purple-100 rounded-full px-6 py-3 text-gray-500 placeholder-gray-400 border-none outline-none focus:ring-2 focus:ring-purple-300" required min="0">
    </div>

    <!-- Tambahkan input warna, spesifikasi, gambar, dll sesuai kebutuhan -->
    <button type="submit" class="bg-[#C8A8E7] text-[#493862] font-semibold px-4 py-2 rounded-full hover:bg-purple-600">
        Add Product
    </button>
</form>
