@extends('layouts.admin')

@section('title', 'Product')

@section('content')
<div x-data="{ showAddModal: false }">
    <!-- Tombol Tambah Produk -->
    <div class="flex justify-center mb-6">
        <button
            @click="showAddModal = true" 
            class="bg-purple-200 text-purple-900 px-4 py-2 rounded-full font-semibold hover:bg-purple-300">
            + Add new product
        </button>
    </div>

    <!-- Modal Tambah Produk -->
    <div
        x-show="showAddModal"
        x-transition style="display: none"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div        
            class="bg-white p-6 rounded-2xl w-full max-w-2xl shadow-lg relative"
            @click.away="showAddModal = false"
        >
            <!-- Tombol close -->
            <button
                @click="showAddModal = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl"
            >
                &times;
            </button>

            <!-- Form Tambah Produk -->
            @include('admin.product._form')
        </div>
    </div>
</div>

<!-- Daftar Produk -->
<div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200 bg-white rounded-xl shadow-md overflow-hidden">
        <thead class="bg-[#C8A8E7] text-white">
            <tr>
                <th class="px-6 py-3 text-center text-sm font-semibold">#</th>
                <th class="px-6 py-3 text-center text-sm font-semibold">Product</th>
                <th class="px-6 py-3 text-center text-sm font-semibold">Price</th>
                <th class="px-6 py-3 text-center text-sm font-semibold">Stock</th>
                <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($products as $index => $product)
            <tr x-data="{ editId: null }" @open-edit.window="editId = $event.detail">
                <td class="px-6 py-4 text-sm text-gray-600 text-center">{{ $index + 1 }}</td>

                <!-- Thumbnail dan Nama Produk -->
                <td class="px-6 py-4 flex items-center space-x-4">
                    <div class="relative w-24 h-24 rounded-lg overflow-hidden">
                        @if($product->images && $product->images->count() > 0)
                            <div class="image-gallery relative w-full h-full">
                                @foreach($product->images as $idx => $image)
                                    <img src="{{ asset('storage/' . $image->path) }}"
                                         alt="{{ $product->name }} - Image {{ $idx + 1 }}"
                                         class="gallery-image absolute inset-0 w-full h-full object-cover transition-opacity duration-300 {{ $idx === 0 ? 'opacity-100' : 'opacity-0' }}"
                                         data-index="{{ $idx }}" />
                                @endforeach

                                @if($product->images->count() > 1)
                                    <button class="nav-btn prev-btn absolute left-1 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-1 rounded-full hover:bg-opacity-70">
                                        <i class="fas fa-chevron-left text-xs"></i>
                                    </button>
                                    <button class="nav-btn next-btn absolute right-1 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-1 rounded-full hover:bg-opacity-70">
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </button>
                                    <div class="absolute bottom-1 right-1 bg-black bg-opacity-50 text-white text-xs px-1 rounded">
                                        <span class="current-image">1</span>/<span class="total-images">{{ $product->images->count() }}</span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="text-base font-semibold text-[#493862]">{{ $product->name }}</p>
                    </div>
                </td>

                <!-- Harga -->
                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                    Rp{{ number_format($product->price, 0, ',', '.') }}/day
                </td>

                <!-- Stok -->
                <td class="px-6 py-4 text-sm text-gray-700 text-center">
                    {{ $product->stock_quantity }}
                </td>

                <!-- Tombol Edit dan Hapus -->
                <td class="px-6 py-4">
                    <div class="flex gap-2 justify-center items-center">
                        <button @click="editId = {{ $product->id }}"
                                class="bg-[#C8A8E7] hover:bg-purple-500 text-white p-2 rounded-full transition">
                            <i class="fas fa-pen text-sm"></i>
                        </button>

                        <form action="{{ route('admin.product.destroy', $product) }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-[#E1AAE1] hover:bg-pink-500 text-white p-2 rounded-full transition">
                                <i class="fas fa-trash text-sm"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Modal Edit -->
                    <div x-show="editId === {{ $product->id }}" x-transition style="display: none"
                         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                        <div class="bg-white p-6 rounded-2xl w-full max-w-2xl shadow-lg relative"
                             @click.away="editId = null">
                            <button @click="editId = null"
                                    class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl">
                                &times;
                            </button>

                            @include('admin.product._update', ['product' => $product, 'categories' => $categories])
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize gallery for each product card
    const galleries = document.querySelectorAll('.image-gallery');
    
    galleries.forEach(gallery => {
        const images = gallery.querySelectorAll('.gallery-image');
        const prevBtn = gallery.querySelector('.prev-btn');
        const nextBtn = gallery.querySelector('.next-btn');
        const dots = gallery.parentElement.parentElement.querySelectorAll('.dot-indicator');
        const currentImageSpan = gallery.querySelector('.current-image');
        
        if (images.length <= 1) return; // Skip if only one image
        
        let currentIndex = 0;
        
        function showImage(index) {
            // Hide all images
            images.forEach(img => img.classList.remove('opacity-100'));
            images.forEach(img => img.classList.add('opacity-0'));
            
            // Show current image
            images[index].classList.remove('opacity-0');
            images[index].classList.add('opacity-100');
            
            // Update dots
            dots.forEach(dot => dot.classList.remove('bg-[#493862]'));
            dots.forEach(dot => dot.classList.add('bg-gray-300'));
            if (dots[index]) {
                dots[index].classList.remove('bg-gray-300');
                dots[index].classList.add('bg-[#493862]');
            }
            
            // Update counter
            if (currentImageSpan) {
                currentImageSpan.textContent = index + 1;
            }
        }
        
        function nextImage() {
            currentIndex = (currentIndex + 1) % images.length;
            showImage(currentIndex);
        }
        
        function prevImage() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            showImage(currentIndex);
        }
        
        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', nextImage);
        if (prevBtn) prevBtn.addEventListener('click', prevImage);
        
        // Dot indicators
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                showImage(currentIndex);
            });
        });
        
        // Auto-slide (optional)
        // setInterval(() => {
        //     nextImage();
        // }, 5000);
    });
});
</script>
@endsection