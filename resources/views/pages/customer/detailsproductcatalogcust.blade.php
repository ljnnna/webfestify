@extends('layouts.details') 

@section('title', 'Details Product')

@section('content')

<!-- ========== Main Content ========== -->
<div
    class="flex flex-col md:flex-row gap-8 px-4 sm:px-6 md:px-10 py-10 max-w-[1280px] mx-auto"
>
    <!-- Product Display -->
    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
        <!-- Product Images -->
        <div class="flex flex-col items-center space-y-6 lg:space-y-10">
            <div class="relative w-72 h-96">
                <img
                    alt="BTS Lightstick with black box behind it, studio product photo"
                    class="w-full h-full object-cover"
                    height="384"
                    src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
                    width="288"
                    id="main-product-image"
                />

                <!-- Image Navigation -->
                <button
                    id="prev-image-btn"
                    aria-label="Previous image"
                    class="absolute top-1/2 -left-10 -translate-y-1/2 bg-white rounded-md p-3 shadow cursor-pointer text-[#2E1B5F] text-xl"
                    onclick="changeImage(-1)"
                >
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button
                    id="next-image-btn"
                    aria-label="Next image"
                    class="absolute top-1/2 -right-10 -translate-y-1/2 bg-[#2E1B5F] rounded-md p-3 shadow cursor-pointer text-white text-xl"
                    onclick="changeImage(1)"
                >
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="flex space-x-6">
                @foreach([
                'https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg',
                'https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg',
                'https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain'
                ] as $index => $image)
                <img
                    alt="Thumbnail image of BTS Lightstick, product photo angle {{ $index + 1 }}"
                    class="thumbnail w-18 h-18 object-cover rounded-sm border-2 {{ $index === 0 ? 'border-[#6B549A]' : 'border-transparent' }} cursor-pointer"
                    height="72"
                    src="{{ $image }}"
                    width="72"
                    data-index="{{ $index }}"
                />
                @endforeach
            </div>
        </div>

        <!-- Product Information -->
        <section class="flex-1 max-w-3xl">
            <h1 class="text-[#1A0041] font-extrabold text-3xl mb-1">
                Lightstick - BTS
            </h1>
            <p class="text-[#7F5CB2] text-xl mb-6">Rp.250.000/day</p>

            <!-- Quantity & Actions -->
            <div class="mb-6 flex items-center space-x-4">
                <div
                    aria-label="Quantity selector"
                    class="flex items-center border border-gray-300 rounded-full overflow-hidden w-36"
                >
                    <button
                        aria-label="Decrease quantity"
                        class="flex-1 py-2 text-2xl text-[#6D5983] font-semibold text-center focus:outline-none"
                        id="decrease-qty"
                    >
                        -
                    </button>
                    <span
                        class="w-10 text-center py-2 text-xl font-semibold text-[#6D5983]"
                        id="qty-display"
                    >
                        1
                    </span>
                    <button
                        aria-label="Increase quantity"
                        class="flex-1 py-2 text-2xl text-[#6D5983] font-semibold text-center focus:outline-none"
                        id="increase-qty"
                    >
                        +
                    </button>
                </div>

                <a
                    href=""
                    class="bg-[#6B549A] text-white rounded-full px-8 py-3 font-semibold text-lg"
                >
                    Add To Cart
                </a>

                <a
                    href=""
                    class="bg-[#6B549A] text-white rounded-full px-8 py-3 font-semibold text-lg"
                >
                    Rent Now
                </a>
            </div>

            <!-- Rental Date -->
            <button
                id="select-date-btn"
                class="w-full bg-[#E6D9F7] text-[#8B7CC4] text-lg font-semibold rounded-full py-3"
                type="button"
            >
                Select Rental Date
            </button>

            <!-- Datepicker Container -->
            <div id="datepicker-container" class="mt-4 hidden">
                <input
                    id="rental-date"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
                    placeholder="Pilih tanggal penyewaan"
                />
            </div>

            <!-- Date Range Picker -->
            <div id="datepicker-wrapper" class="mt-6 space-y-4 hidden">
                <!-- Tanggal Mulai -->
                <div>
                    <label
                        for="start-date"
                        class="block text-[#6D5983] font-semibold mb-1"
                        >Rental Start Date</label
                    >
                    <input
                        id="start-date"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
                        placeholder="Select rental start date"
                    />
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label
                        for="end-date"
                        class="block text-[#6D5983] font-semibold mb-1"
                        >Rental End Date</label
                    >
                    <input
                        id="end-date"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
                        placeholder="Select rental end date"
                    />
                </div>
            </div>

            <!-- Deskripsi & Detail -->
            <div class="mt-10 border-t border-gray-300 pt-6 flex space-x-20">
                <button
                    id="description-btn"
                    class="text-[#2E1B5F] font-extrabold text-2xl border-b-4 border-[#2E1B5F] pb-2"
                    type="button"
                >
                    Description
                </button>
                <button
                    id="details-btn"
                    class="text-[#2E1B5F] font-extrabold text-2xl pb-2"
                    type="button"
                >
                    Details
                </button>
            </div>
            <div id="description" class="content">
                <p
                    class="mt-4 text-[#8B7CC4] font-semibold text-base max-w-3xl leading-relaxed"
                >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>

            <div id="details" class="content hidden">
                <p
                    class="mt-4 text-[#8B7CC4] font-semibold text-base max-w-3xl leading-relaxed"
                >
                    Here are the details about the product, including
                    specifications, features, and other relevant information.
                </p>
            </div>
        </section>
    </div>
</div>

<!-- Customer Reviews -->
@include('components.reviews') @endsection @section('scripts')
<script>
// ========== Object-Oriented Implementation ==========

// Base Product Class
class Product {
    constructor(name, price, images, description, details) {
        this.name = name;
        this.price = price;
        this.images = images;
        this.description = description;
        this.details = details;
    }

    getFormattedPrice() {
        return `Rp.${this.price.toLocaleString()}/day`;
    }

    getImageCount() {
        return this.images.length;
    }
}

// Image Gallery Class
class ImageGallery {
    constructor(images, mainImageId, thumbnailClass) {
        this.images = images;
        this.currentIndex = 0;
        this.mainImage = document.getElementById(mainImageId);
        this.thumbnails = document.querySelectorAll(`.${thumbnailClass}`);
        this.prevButton = document.getElementById('prev-image-btn');
        this.nextButton = document.getElementById('next-image-btn');
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateDisplay();
    }

    bindEvents() {
        // Previous button
        this.prevButton?.addEventListener('click', () => this.previousImage());
        
        // Next button
        this.nextButton?.addEventListener('click', () => this.nextImage());
        
        // Thumbnail clicks
        this.thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => this.goToImage(index));
        });
    }

    previousImage() {
        if (this.currentIndex > 0) {
            this.currentIndex--;
            this.updateDisplay();
        }
    }

    nextImage() {
        if (this.currentIndex < this.images.length - 1) {
            this.currentIndex++;
            this.updateDisplay();
        }
    }

    goToImage(index) {
        if (index >= 0 && index < this.images.length) {
            this.currentIndex = index;
            this.updateDisplay();
        }
    }

    updateDisplay() {
        // Update main image
        if (this.mainImage) {
            this.mainImage.src = this.images[this.currentIndex];
        }

        // Update thumbnails
        this.updateThumbnails();
        
        // Update button states
        this.updateButtonStates();
    }

    updateThumbnails() {
        this.thumbnails.forEach((thumbnail, index) => {
            if (index === this.currentIndex) {
                thumbnail.classList.add('border-[#6B549A]');
                thumbnail.classList.remove('border-transparent');
            } else {
                thumbnail.classList.remove('border-[#6B549A]');
                thumbnail.classList.add('border-transparent');
            }
        });
    }

    updateButtonStates() {
        if (this.prevButton) {
            this.prevButton.disabled = this.currentIndex === 0;
        }
        if (this.nextButton) {
            this.nextButton.disabled = this.currentIndex === this.images.length - 1;
        }
    }
}

// Quantity Controller Class
class QuantityController {
    constructor(initialQuantity = 1, minQuantity = 1, maxQuantity = 99) {
        this.quantity = initialQuantity;
        this.minQuantity = minQuantity;
        this.maxQuantity = maxQuantity;
        
        this.decreaseBtn = document.getElementById('decrease-qty');
        this.increaseBtn = document.getElementById('increase-qty');
        this.display = document.getElementById('qty-display');
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.updateDisplay();
    }

    bindEvents() {
        this.decreaseBtn?.addEventListener('click', () => this.decrease());
        this.increaseBtn?.addEventListener('click', () => this.increase());
    }

    decrease() {
        if (this.quantity > this.minQuantity) {
            this.quantity--;
            this.updateDisplay();
            this.onQuantityChange();
        }
    }

    increase() {
        if (this.quantity < this.maxQuantity) {
            this.quantity++;
            this.updateDisplay();
            this.onQuantityChange();
        }
    }

    updateDisplay() {
        if (this.display) {
            this.display.textContent = this.quantity;
        }
    }

    getQuantity() {
        return this.quantity;
    }

    setQuantity(newQuantity) {
        if (newQuantity >= this.minQuantity && newQuantity <= this.maxQuantity) {
            this.quantity = newQuantity;
            this.updateDisplay();
            this.onQuantityChange();
        }
    }

    onQuantityChange() {
        // Override this method for custom behavior
        console.log(`Quantity changed to: ${this.quantity}`);
    }
}

// Date Picker Class
class RentalDatePicker {
    constructor() {
        this.selectDateBtn = document.getElementById('select-date-btn');
        this.datepickerWrapper = document.getElementById('datepicker-wrapper');
        this.startDateInput = document.getElementById('start-date');
        this.endDateInput = document.getElementById('end-date');
        
        this.startDate = null;
        this.endDate = null;
        
        this.init();
    }

    init() {
        this.bindEvents();
        this.initializeDatePickers();
    }

    bindEvents() {
        this.selectDateBtn?.addEventListener('click', () => this.toggleDatePicker());
    }

    initializeDatePickers() {
        if (typeof flatpickr !== 'undefined') {
            // Start date picker
            this.startPicker = flatpickr(this.startDateInput, {
                minDate: 'today',
                dateFormat: 'Y-m-d',
                onChange: (selectedDates) => {
                    if (selectedDates.length > 0) {
                        this.startDate = selectedDates[0];
                        this.endPicker?.set('minDate', selectedDates[0]);
                    }
                }
            });

            // End date picker
            this.endPicker = flatpickr(this.endDateInput, {
                minDate: 'today',
                dateFormat: 'Y-m-d',
                onChange: (selectedDates) => {
                    if (selectedDates.length > 0) {
                        this.endDate = selectedDates[0];
                    }
                }
            });
        }
    }

    toggleDatePicker() {
        if (this.datepickerWrapper) {
            this.datepickerWrapper.classList.toggle('hidden');
        }
    }

    getDateRange() {
        return {
            startDate: this.startDate,
            endDate: this.endDate
        };
    }

    getRentalDays() {
        if (this.startDate && this.endDate) {
            const timeDiff = this.endDate.getTime() - this.startDate.getTime();
            return Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
        }
        return 0;
    }
}

// Tab Manager Class
class TabManager {
    constructor(tabs) {
        this.tabs = tabs;
        this.activeTab = null;
        this.init();
    }

    init() {
        this.tabs.forEach(tab => {
            const button = document.getElementById(tab.buttonId);
            const content = document.getElementById(tab.contentId);
            
            if (button && content) {
                button.addEventListener('click', () => this.switchTab(tab.id));
            }
        });

        // Set default active tab
        if (this.tabs.length > 0) {
            this.switchTab(this.tabs[0].id);
        }
    }

    switchTab(tabId) {
        const targetTab = this.tabs.find(tab => tab.id === tabId);
        if (!targetTab) return;

        // Hide all tabs and remove active states
        this.tabs.forEach(tab => {
            const button = document.getElementById(tab.buttonId);
            const content = document.getElementById(tab.contentId);
            
            if (content) content.classList.add('hidden');
            if (button) {
                button.classList.remove('border-b-4', 'border-[#2E1B5F]');
            }
        });

        // Show active tab and add active state
        const activeButton = document.getElementById(targetTab.buttonId);
        const activeContent = document.getElementById(targetTab.contentId);
        
        if (activeContent) activeContent.classList.remove('hidden');
        if (activeButton) {
            activeButton.classList.add('border-b-4', 'border-[#2E1B5F]');
        }

        this.activeTab = tabId;
    }

    getActiveTab() {
        return this.activeTab;
    }
}

// Rating System Class
class RatingSystem {
    constructor(containerId, maxRating = 5) {
        this.container = document.getElementById(containerId);
        this.maxRating = maxRating;
        this.selectedRating = 0;
        this.stars = [];
        
        this.init();
    }

    init() {
        if (this.container) {
            this.stars = this.container.querySelectorAll('i');
            this.bindEvents();
        }
    }

    bindEvents() {
        this.stars.forEach((star, index) => {
            star.addEventListener('click', () => this.setRating(index + 1));
            star.addEventListener('mouseenter', () => this.previewRating(index + 1));
            star.addEventListener('mouseleave', () => this.updateDisplay());
        });
    }

    setRating(rating) {
        if (rating >= 1 && rating <= this.maxRating) {
            this.selectedRating = rating;
            this.updateDisplay();
            this.onRatingChange(rating);
        }
    }

    previewRating(rating) {
        this.updateStars(rating);
    }

    updateDisplay() {
        this.updateStars(this.selectedRating);
    }

    updateStars(rating) {
        this.stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('far');
                star.classList.add('fas');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    }

    getRating() {
        return this.selectedRating;
    }

    onRatingChange(rating) {
        // Override this method for custom behavior
        console.log(`Rating changed to: ${rating}`);
    }
}

// Main Product Details Controller
class ProductDetailsController {
    constructor(productData) {
        this.product = new Product(
            productData.name,
            productData.price,
            productData.images,
            productData.description,
            productData.details
        );

        this.imageGallery = new ImageGallery(
            this.product.images,
            'main-product-image',
            'thumbnail'
        );

        this.quantityController = new QuantityController();
        this.datePicker = new RentalDatePicker();
        
        this.tabManager = new TabManager([
            { id: 'description', buttonId: 'description-btn', contentId: 'description' },
            { id: 'details', buttonId: 'details-btn', contentId: 'details' }
        ]);

        this.ratingSystem = new RatingSystem('rating');
        
        this.init();
    }

    init() {
        this.bindCartEvents();
        console.log('Product Details Controller initialized');
    }

    bindCartEvents() {
        // Add to cart functionality
        const addToCartBtn = document.querySelector('a[href=""]');
        if (addToCartBtn) {
            addToCartBtn.addEventListener('click', (e) => {
                e.preventDefault();
                this.addToCart();
            });
        }
    }

    addToCart() {
        const cartItem = {
            product: this.product,
            quantity: this.quantityController.getQuantity(),
            dateRange: this.datePicker.getDateRange(),
            totalDays: this.datePicker.getRentalDays()
        };

        console.log('Adding to cart:', cartItem);
        // Here you would typically send this to your backend or local storage
    }

    getTotalPrice() {
        const quantity = this.quantityController.getQuantity();
        const days = this.datePicker.getRentalDays() || 1;
        return this.product.price * quantity * days;
    }
}

// ========== Initialize Application ==========
document.addEventListener('DOMContentLoaded', function() {
    // Product data - this would typically come from your backend
    const productData = {
        name: 'Lightstick - BTS',
        price: 250000,
        images: [
            'https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg',
            'https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg',
            'https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg',
            'https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain'
        ],
        description: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit...',
        details: 'Here are the details about the product, including specifications...'
    };

    // Initialize the main controller
    window.productController = new ProductDetailsController(productData);
});
</script>
@endsection
