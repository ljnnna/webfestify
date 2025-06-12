<!-- Container utama dengan background gradient purple -->
<div class="bg-[#EBE1F9] rounded-3xl p-6 shadow-lg">
    <!-- Image Gallery Container -->
    <div class="relative flex flex-col items-center mb-4">
        <!-- Main Image Display -->
        <div class="relative w-full h-64 rounded-xl overflow-hidden">
            @if($product->images && $product->images->count() > 0)
                <!-- Display multiple images if available -->
                <div class="image-gallery relative w-full h-full">
                    @foreach($product->images as $index => $image)
                        <img src="{{ asset('storage/' . $image->path) }}" 
                             alt="{{ $product->name }} - Image {{ $index + 1 }}" 
                             class="gallery-image absolute inset-0 w-full h-full object-cover transition-opacity duration-300 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" 
                             data-index="{{ $index }}" />
                    @endforeach
                    
                    <!-- Navigation Arrows (only show if more than 1 image) -->
                    @if($product->images->count() > 1)
                        <button class="nav-btn prev-btn absolute left-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </button>
                        <button class="nav-btn next-btn absolute right-2 top-1/2 transform -translate-y-1/2 bg-black bg-opacity-50 text-white p-2 rounded-full hover:bg-opacity-70 transition-all">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </button>
                        
                        <!-- Image Counter -->
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-50 text-white px-2 py-1 rounded-full text-xs">
                            <span class="current-image">1</span>/<span class="total-images">{{ $product->images->count() }}</span>
                        </div>
                    @endif
                </div>
            @else
                <!-- Fallback jika tidak ada gambar sama sekali -->
                <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-image text-4xl mb-2"></i>
                        <p>No Image Available</p>
                    </div>
                </div>
            @endif
        </div>
        
        <!-- Image Dots Indicator (only show if more than 1 image) -->
        @if($product->images && $product->images->count() > 1)
            <div class="flex space-x-2 mt-3">
                @foreach($product->images as $index => $image)
                    <button class="dot-indicator w-2 h-2 rounded-full transition-all {{ $index === 0 ? 'bg-[#493862]' : 'bg-gray-300' }}" 
                            data-index="{{ $index }}"></button>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Nama produk -->
    <h3 class="text-xl font-bold text-[#493862] m-2 text-center">{{ $product->name }}</h3>
    
    <!-- Container untuk harga dan tombol aksi -->
    <div class="flex items-center justify-between mb-2">
        <!-- Harga -->
        <div class="bg-white px-4 py-2 text-center rounded-full w-[70%]">
            <p class="text-base font-medium text-gray-700">
                Rp{{ number_format($product->price, 0, ',', '.') }}/day
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

<!-- JavaScript untuk Image Gallery -->
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
        
        // Auto-slide (optional - uncomment if you want auto-sliding)
        // setInterval(() => {
        //     nextImage();
        // }, 5000);
    });
});
</script>