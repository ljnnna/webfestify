<!-- Product Images -->
<div class="flex flex-col items-center space-y-6">
    <div class="relative w-72 h-96">
    <img alt="Product photo" class="w-full h-full object-cover rounded-lg shadow-lg"
        src="{{ asset('storage/' . $productImages[0]) }}" id="main-product-image" />

        <!-- Navigation Buttons -->
        <button id="prev-image-btn"
            class="absolute top-1/2 -left-10 -translate-y-1/2 bg-white rounded-full p-3 shadow-lg text-[#2E1B5F] hover:bg-gray-50 transition-colors">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="next-image-btn"
            class="absolute top-1/2 -right-10 -translate-y-1/2 bg-[#2E1B5F] rounded-full p-3 shadow-lg text-white hover:bg-[#1a0f3d] transition-colors">
            <i class="fas fa-chevron-right"></i>
        </button>
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
</script>

<script>
const imageGallery = {
    currentIndex: 0,

    init() {
        this.bindEvents();
        this.updateNavigationButtons(); // Initialize button states
    },

    bindEvents() {
        document.getElementById('prev-image-btn')?.addEventListener('click', () => this.previous());
        document.getElementById('next-image-btn')?.addEventListener('click', () => this.next());

        document.querySelectorAll('.thumbnail').forEach((thumb) => {
            thumb.addEventListener('click', () => {
        const index = parseInt(thumb.dataset.index, 10);
        this.goTo(index);
    });


        });
    },

    previous() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.updateDisplay();
        }
    },

    next() {
        if (this.currentIndex < PRODUCT_CONFIG.images.length - 1) {
            this.currentIndex++;
            this.updateDisplay();
        }
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

        this.updateNavigationButtons();
    },

    updateNavigationButtons() {
        const prevBtn = document.getElementById('prev-image-btn');
        const nextBtn = document.getElementById('next-image-btn');

        if (prevBtn) {
            prevBtn.disabled = this.currentIndex === 0;
            prevBtn.classList.toggle('opacity-50', this.currentIndex === 0);
            prevBtn.classList.toggle('cursor-not-allowed', this.currentIndex === 0);
            prevBtn.classList.toggle('hover:bg-gray-50', this.currentIndex !== 0);
        }

        if (nextBtn) {
            nextBtn.disabled = this.currentIndex === PRODUCT_CONFIG.images.length - 1;
            nextBtn.classList.toggle('opacity-50', this.currentIndex === PRODUCT_CONFIG.images.length - 1);
            nextBtn.classList.toggle('cursor-not-allowed', this.currentIndex === PRODUCT_CONFIG.images.length - 1);
            nextBtn.classList.toggle('hover:bg-[#1a0f3d]', this.currentIndex !== PRODUCT_CONFIG.images.length - 1);
        }
    }
};

// Panggil init terakhir, setelah semua siap

</script>
