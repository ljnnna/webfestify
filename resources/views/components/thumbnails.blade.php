<!-- Product Images -->
<div class="flex flex-col items-center space-y-6">
    <div class="relative w-96 h-96">
        <img alt="Product photo" class="w-full h-full object-cover rounded shadow"
            src="{{ asset('storage/' . $productImages[0]) }}" id="main-product-image" />
    </div>

    <!-- Thumbnails -->
    <div class="flex space-x-4">
        @foreach ($productImages as $index => $image)
        <img
            class="thumbnail w-20 h-20 object-cover rounded-lg border-2 {{ $index === 0 ? 'border-[#6B549A]' : 'border-gray-200' }} cursor-pointer hover:border-[#6B549A] transition-colors"
            src="{{ asset('storage/' . $image) }}"
            data-index="{{ $index }}"
        />
        @endforeach
    </div>
</div>


<script>
const PRODUCT_CONFIG = {
    images: @json(array_map(fn($img) => asset('storage/' . $img), $productImages)),
    maxQuantity: 10
};

const imageGallery = {
    currentIndex: 0,

    init() {
        this.bindEvents();
        this.updateDisplay();
    },

    bindEvents() {
        // Ubah ke hover
        document.querySelectorAll('.thumbnail').forEach((thumb) => {
            thumb.addEventListener('mouseover', () => {
                const index = parseInt(thumb.dataset.index, 10);
                this.goTo(index);
            });
        });

        // Optional: Jika masih mau pakai tombol manual
        document.getElementById('prev-image-btn')?.addEventListener('click', () => this.previous());
        document.getElementById('next-image-btn')?.addEventListener('click', () => this.next());
    },

    goTo(index) {
        this.currentIndex = index;
        this.updateDisplay();
    },

    updateDisplay() {
        const mainImage = document.getElementById('main-product-image');
        if (mainImage) {
            mainImage.src = PRODUCT_CONFIG.images[this.currentIndex];
        }

        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
            thumb.classList.toggle('border-[#6B549A]', index === this.currentIndex);
            thumb.classList.toggle('border-gray-200', index !== this.currentIndex);
        });
    }
};

// Jalankan saat halaman selesai dimuat
document.addEventListener('DOMContentLoaded', () => imageGallery.init());
</script>
