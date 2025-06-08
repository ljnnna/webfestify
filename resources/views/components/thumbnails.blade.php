<!-- Product Images -->
<div class="flex flex-col items-center space-y-6">
    <div class="relative w-72 h-96">
        <img alt="BTS Lightstick product photo" class="w-full h-full object-cover rounded-lg shadow-lg"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg" id="main-product-image" />

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
        @foreach([
        'https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg',
        'https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg',
        'https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg',
        'https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain'
        ] as $index => $image)
        <img class="thumbnail w-20 h-20 object-cover rounded-lg border-2 {{ $index === 0 ? 'border-[#6B549A]' : 'border-gray-200' }} cursor-pointer hover:border-[#6B549A] transition-colors"
            src="{{ $image }}" data-index="{{ $index }}" />
        @endforeach
    </div>
</div>

<script>
// Image gallery manager
// Image gallery manager dengan navigation button yang disabled
const imageGallery = {
    currentIndex: 0,

    init() {
        this.bindEvents();
        this.updateNavigationButtons(); // Initialize button states
    },

    bindEvents() {
        document.getElementById('prev-image-btn')?.addEventListener('click', () => this.previous());
        document.getElementById('next-image-btn')?.addEventListener('click', () => this.next());

        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
            thumb.addEventListener('click', () => this.goTo(index));
        });
    },

    previous() {
        // Hanya pindah jika tidak di gambar pertama
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.updateDisplay();
        }
    },

    next() {
        // Hanya pindah jika tidak di gambar terakhir
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

        // Update thumbnail borders
        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
            thumb.classList.toggle('border-[#6B549A]', index === this.currentIndex);
            thumb.classList.toggle('border-gray-200', index !== this.currentIndex);
        });

        // Update navigation buttons
        this.updateNavigationButtons();
    },

    updateNavigationButtons() {
        const prevBtn = document.getElementById('prev-image-btn');
        const nextBtn = document.getElementById('next-image-btn');

        if (prevBtn) {
            if (this.currentIndex === 0) {
                // Disable prev button - di gambar pertama
                prevBtn.disabled = true;
                prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
                prevBtn.classList.remove('hover:bg-gray-50');
            } else {
                // Enable prev button
                prevBtn.disabled = false;
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                prevBtn.classList.add('hover:bg-gray-50');
            }
        }

        if (nextBtn) {
            if (this.currentIndex === PRODUCT_CONFIG.images.length - 1) {
                // Disable next button - di gambar terakhir
                nextBtn.disabled = true;
                nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                nextBtn.classList.remove('hover:bg-[#1a0f3d]');
            } else {
                // Enable next button
                nextBtn.disabled = false;
                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                nextBtn.classList.add('hover:bg-[#1a0f3d]');
            }
        }
    }
};
</script>