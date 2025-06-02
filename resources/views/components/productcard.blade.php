<div class="bg-purple-100 rounded-2xl shadow-md overflow-hidden">
    <!-- Konten atas -->
    <div class="p-4 flex flex-col items-center">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full max-h-64 object-contain mb-2 mx-auto" />
        <h2 class="font-bold text-center">{{ $product['name'] }}</h2>
        
        <div class="flex gap-2 mt-2">
            <p class="text-sm bg-white px-2 py-1 rounded-full">Rp{{ number_format($product['price'], 0, ',', '.') }}/day</p>
            <p class="text-sm bg-white px-2 py-1 rounded-full">Stok tersedia: {{ $product->stock_quantity }}</p>
        </div>
    </div>

    <!-- Background penuh di bawah -->
    <div class="bg-white grid grid-cols-2 divide-x divide-purple-200">
        <!-- Tombol Edit -->
        <a @click="$dispatch('open-edit', {{ $product->id }})"
            class="flex items-center justify-center text-purple-700 hover:text-purple-900 py-3 cursor-pointer">
            <i class="fas fa-pen"></i>
        </a>


        <!-- Tombol Hapus -->
        <form action="{{ route('admin.product.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="flex items-center justify-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 py-3">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>