<!-- Container utama dengan background gradient purple -->
<div class="bg-[#EBE1F9] rounded-3xl p-6 shadow-lg">
    <div class=" flex flex-col items-center">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rounded-xl w-full h-64 object-cover" />
    </div>
    <!-- Nama produk -->
    <h3 class="text-xl font-bold text-[#493862] m-2 text-center">{{ $product->name }}</h3>
    
    <!-- Container untuk harga dan tombol aksi -->
    <div class="flex items-center justify-between mb-2">
        <!-- Harga -->
        <div class="bg-white px-4 py-2 text-center rounded-full w-[70%]">
            <p class="text-base font-medium text-gray-700">
                Rp{{ number_format($product['price'], 0, ',', '.') }}/day
            </p>
        </div>
        
        <!-- Tombol aksi (Edit & Delete) -->
        <div class="flex gap-2">
            <!-- Tombol Edit -->
            <a @click="$dispatch('open-edit', {{ $product->id }})" 
               class="bg-[#C8A8E7] hover:bg-purple-500 text-white p-3 rounded-full cursor-pointer transition-colors duration-200">
                <i class="fas fa-pen text-sm"></i>
            </a>
            
            <!-- Tombol Hapus -->
            <form action="{{ route('admin.product.destroy', $product) }}" method="POST" 
                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="bg-[#E1AAE1] hover:bg-pink-500 text-white p-3 rounded-full transition-colors duration-200">
                    <i class="fas fa-trash text-sm"></i>
                </button>
            </form>
        </div>
    </div>
    
    <!-- Stock quantity di bagian bawah -->
    <div class="flex items-center justify-between mb-2">
        <div class="bg-white px-4 py-2 rounded-full flex-1 text-center">
            <p class="text-center text-base font-medium text-gray-700">
                Stok tersedia: {{ $product->stock_quantity }}
            </p>
        </div>
    </div>
</div>

<!-- <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full">
    <div class="flex-shrink-0 mb-4">
        <img
        src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
        class="rounded-xl w-full h-48 object-cover"
        />
    </div>
    <div class="flex flex-col flex-grow justify-between">
        <div class="mb-4">
            <h3 class="text-[#493862] font-semibold text-sm mb-2">
            Lightstick Seventeen</h3>
            <p class="text-[#493862] text-xs">Rp200.000/day</p>
        </div>
        <a
        href="{{ route('details') }}"
        class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
        >
        Details
        </a>
    </div>
</article> -->

