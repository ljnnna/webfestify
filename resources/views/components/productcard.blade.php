<div class="bg-purple-100 rounded-2xl shadow-md p-4 flex flex-col items-center">
    <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" class="w-32 h-32 object-contain mb-2" />
    <h3 class="font-bold text-center">{{ $product['name'] }}</h3>
    <p class="text-sm bg-white px-2 py-1 rounded-full mt-1 mb-2">Rp{{ number_format($product['price'], 0, ',', '.') }}/day</p>
    <p class="text-sm text-gray-600">Stok tersedia: {{ $product->stock_quantity }}</p>

    <div class="flex gap-2">
        <!-- Tombol Edit -->
        <a href="{{ route('product.edit', $product) }}" class="text-purple-700 hover:text-purple-900">
            <i class="fas fa-pen"></i>
        </a>

        <!-- Tombol Hapus -->
        <form action="{{ route('product.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700">
                <i class="fas fa-trash"></i>
            </button>
        </form>
    </div>
</div>
