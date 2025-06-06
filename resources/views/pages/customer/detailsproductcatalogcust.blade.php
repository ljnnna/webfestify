@extends('layouts.details')

@section('title', 'Details Product')

@section('content')
<!-- Main Content -->
<div class="flex flex-col md:flex-row gap-8 px-4 sm:px-6 md:px-10 py-10 max-w-[1280px] mx-auto">
    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
        <!-- Product Images -->
        <div class="flex flex-col items-center space-y-6">
            <div class="relative w-72 h-96">
                <img alt="BTS Lightstick product photo" class="w-full h-full object-cover rounded-lg shadow-lg"
                    src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg" id="main-product-image" />

                <!-- Navigation Buttons -->
                <button id="prev-image-btn" class="absolute top-1/2 -left-10 -translate-y-1/2 bg-white rounded-full p-3 shadow-lg text-[#2E1B5F] hover:bg-gray-50 transition-colors">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button id="next-image-btn" class="absolute top-1/2 -right-10 -translate-y-1/2 bg-[#2E1B5F] rounded-full p-3 shadow-lg text-white hover:bg-[#1a0f3d] transition-colors">
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

        <!-- Product Information -->
        <section class="flex-1 max-w-3xl">
            <h1 class="text-[#1A0041] font-extrabold text-3xl mb-2">Lightstick - BTS</h1>
            <p class="text-[#7F5CB2] text-2xl font-bold mb-8">Rp.250.000/day</p>

            <!-- Quantity & Actions -->
            <div class="mb-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-[#6D5983] font-semibold">Quantity:</label>
                    <div class="flex items-center border-2 border-gray-300 rounded-full overflow-hidden w-32">
                        <button id="decrease-qty" class="flex-1 py-2 text-xl text-[#6D5983] font-bold hover:bg-gray-50 transition-colors">-</button>
                        <span id="qty-display" class="w-12 text-center py-2 text-lg font-semibold text-[#6D5983] border-x border-gray-300">1</span>
                        <button id="increase-qty" class="flex-1 py-2 text-xl text-[#6D5983] font-bold hover:bg-gray-50 transition-colors">+</button>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button id="add-to-cart-btn" class="bg-[#6B549A] text-white rounded-full px-6 py-3 font-semibold hover:bg-[#5a4788] transition-colors shadow-lg">Add To Cart</button>
                    <button id="rent-now-btn" class="bg-[#2E1B5F] text-white rounded-full px-6 py-3 font-semibold hover:bg-[#1a0f3d] transition-colors shadow-lg">Rent Now</button>
                </div>
            </div>

            <!-- Rental Date Selection -->
            <div class="mb-8">
                <button id="select-date-btn" class="w-full bg-[#E6D9F7] text-[#6B549A] font-semibold rounded-full py-3 hover:bg-[#d4c2f0] transition-colors">Select Rental Date</button>

                <div id="datepicker-wrapper" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                    <div>
                        <label class="block text-[#6D5983] font-semibold mb-2">Start Date</label>
                        <input id="start-date" type="date" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-[#6D5983] focus:border-[#6B549A] transition-colors" />
                    </div>
                    <div>
                        <label class="block text-[#6D5983] font-semibold mb-2">End Date</label>
                        <input id="end-date" type="date" class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-[#6D5983] focus:border-[#6B549A] transition-colors" />
                    </div>
                </div>
            </div>

            <!-- Delivery Option -->
            <div class="mb-8">
                <button id="select-delivery-btn" class="w-full bg-[#E6D9F7] text-[#6B549A] font-semibold rounded-full py-3 hover:bg-[#d4c2f0] transition-colors">
                    Select Delivery Option
                </button>

                <div id="delivery-options-wrapper" class="mt-6 space-y-4 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Pick Up -->
                        <button id="pickup-option-btn" class="delivery-option-btn border-2 border-gray-300 rounded-lg p-4 text-left hover:border-[#6B549A] transition-colors">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-store text-[#6B549A]"></i>
                                <div>
                                    <div class="font-medium text-[#2E1B5F]">Pick Up</div>
                                    <div class="text-sm text-[#6D5983]">Free - Pick up at store</div>
                                </div>
                            </div>
                        </button>

                        <!-- Delivery -->
                        <button id="delivery-option-btn" class="delivery-option-btn border-2 border-gray-300 rounded-lg p-4 text-left hover:border-[#6B549A] transition-colors">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-truck text-[#6B549A]"></i>
                                <div>
                                    <div class="font-medium text-[#2E1B5F]">Delivery</div>
                                    <div class="text-sm text-[#6D5983]">Rp.10.000 - Delivered to address</div>
                                </div>
                            </div>
                        </button>
                    </div>

                    <!-- Pickup Info -->
                    <div id="pickup-info" class="bg-[#F8F4FF] border border-[#E6D9F7] p-4 rounded-lg hidden">
                        <h4 class="font-semibold text-[#2E1B5F] mb-2">Store Information</h4>
                        <p class="text-sm text-[#6D5983] mb-1">
                            <i class="fas fa-map-marker-alt mr-2 text-[#6B549A]"></i>
                            Jl. Ahmad Yani, Batam Center, Batam
                        </p>
                        <p class="text-sm text-[#6D5983]">
                            <i class="fas fa-clock mr-2 text-[#6B549A]"></i>
                            Open: Monday - Friday, 08:00 - 17:00
                        </p>
                    </div>

                    <!-- Delivery Address Form -->
                    <div id="delivery-address-form" class="bg-[#F8F4FF] border border-[#E6D9F7] p-4 rounded-lg hidden">
                        <h4 class="font-semibold text-[#2E1B5F] mb-3">Delivery Address</h4>
                        <div class="space-y-3">
                            <textarea id="delivery-address" rows="3" class="w-full border-2 border-gray-300 rounded-lg p-3 text-[#6D5983] focus:border-[#6B549A] transition-colors resize-none" placeholder="Enter complete address..."></textarea>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="tel" id="phone-number" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 text-[#6D5983] focus:border-[#6B549A] transition-colors" placeholder="Phone number" />
                                <input type="text" id="recipient-name" class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 text-[#6D5983] focus:border-[#6B549A] transition-colors" placeholder="Recipient name" />
                            </div>
                            <button id="save-delivery-address-btn" class="w-full bg-[#6B549A] text-white rounded-full py-2 font-semibold hover:bg-[#5a4788] transition-colors">Save Address</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="mt-6 sm:mt-10 border-t border-gray-300 pt-4 sm:pt-6">
                <div class="flex flex-wrap sm:flex-nowrap space-x-4 sm:space-x-8 border-b border-gray-200 overflow-x-auto">
                    <button id="description-btn" class="text-[#2E1B5F] font-bold pb-3 border-b-2 border-[#2E1B5F] transition-all duration-200 hover:text-[#2E1B5F] whitespace-nowrap">Description</button>
                    <button id="details-btn" class="text-[#8B7CC4] font-bold pb-3 border-b-2 border-transparent hover:text-[#2E1B5F] transition-all duration-200 whitespace-nowrap">Details</button>
                    <button id="specifications-btn" class="text-[#8B7CC4] font-bold pb-3 border-b-2 border-transparent hover:text-[#2E1B5F] transition-all duration-200 whitespace-nowrap">Specifications</button>
                </div>

                <!-- Tab Contents -->
                <div class="mt-4 sm:mt-6 relative min-h-[100px]">
                    <div id="description" class="tab-content opacity-100 transition-opacity duration-300">
                        <p class="text-[#6D5983] leading-relaxed text-sm sm:text-base">
                            Official BTS Army Bomb Light Stick Ver. 4 with Bluetooth connectivity, synchronized lighting
                            effects,
                            and ergonomic design. Perfect for concerts and events.
                        </p>
                    </div>

                    <div id="details" class="tab-content opacity-0 absolute inset-0 transition-opacity duration-300 pointer-events-none">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 text-[#6D5983]">
                            <div>
                                <h4 class="font-semibold text-[#2E1B5F] mb-2 text-sm sm:text-base">Rental Info</h4>
                                <ul class="space-y-1.5 text-xs sm:text-sm">
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Min rental: 1 day</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Max rental: 7 days</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Clean return required</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#2E1B5F] mb-2 text-sm sm:text-base">Included</h4>
                                <ul class="space-y-1.5 text-xs sm:text-sm">
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Light stick</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Batteries</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Manual & strap</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="specifications" class="tab-content opacity-0 absolute inset-0 transition-opacity duration-300 pointer-events-none">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6 text-[#6D5983]">
                            <div>
                                <h4 class="font-semibold text-[#2E1B5F] mb-2 text-sm sm:text-base">Technical Specs</h4>
                                <ul class="space-y-1.5 text-xs sm:text-sm">
                                    <li class="flex items-start">
                                        <span class="font-medium flex-shrink-0 mr-3 w-20 sm:w-24">Model:</span>
                                        <span>Army Bomb Ver. 4</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="font-medium flex-shrink-0 mr-3 w-20 sm:w-24">Connectivity:</span>
                                        <span>Bluetooth 5.0</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="font-medium flex-shrink-0 mr-3 w-20 sm:w-24">Battery:</span>
                                        <span>2x AAA (8hr life)</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="font-medium flex-shrink-0 mr-3 w-20 sm:w-24">Size:</span>
                                        <span>24 x 8 x 8 cm</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-semibold text-[#2E1B5F] mb-2 text-sm sm:text-base">Features</h4>
                                <ul class="space-y-1.5 text-xs sm:text-sm">
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Synchronized lighting</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Multiple color modes</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>App connectivity</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span class="text-[#8B7CC4] mr-2 flex-shrink-0">•</span>
                                        <span>Ergonomic design</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>
    </div>
</div>

@include('components.reviews')
@endsection

@section('scripts')
<script>
// Product configuration
const PRODUCT_CONFIG = {
    id: 'bts-lightstick-001',
    name: 'Lightstick - BTS',
    price: 250000,
    maxQuantity: 10,
    images: [
        'https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg',
        'https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg',
        'https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg',
        'https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain'
    ]
};

// Utility functions
const utils = {
    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 max-w-sm p-4 rounded-lg shadow-lg transform transition-all duration-300 ${
            type === 'success' ? 'bg-green-100 border-green-400 text-green-800' :
            type === 'error' ? 'bg-red-100 border-red-400 text-red-800' :
            type === 'warning' ? 'bg-yellow-100 border-yellow-400 text-yellow-800' :
            'bg-blue-100 border-blue-400 text-blue-800'
        }`;

        notification.innerHTML = `
            <div class="flex justify-between items-center">
                <span class="text-sm font-medium">${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        document.body.appendChild(notification);
        setTimeout(() => notification.remove(), 5000);
    },

    formatPrice(price) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    },

    getTodayDate() {
        return new Date().toISOString().split('T')[0];
    }
};

// Image gallery manager
const imageGallery = {
    currentIndex: 0,

    init() {
        this.bindEvents();
    },

    bindEvents() {
        document.getElementById('prev-image-btn')?.addEventListener('click', () => this.previous());
        document.getElementById('next-image-btn')?.addEventListener('click', () => this.next());

        document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
            thumb.addEventListener('click', () => this.goTo(index));
        });
    },

    previous() {
        this.currentIndex = this.currentIndex > 0 ? this.currentIndex - 1 : PRODUCT_CONFIG.images.length - 1;
        this.updateDisplay();
    },

    next() {
        this.currentIndex = this.currentIndex < PRODUCT_CONFIG.images.length - 1 ? this.currentIndex + 1 : 0;
        this.updateDisplay();
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

// Quantity controller
const quantityController = {
    quantity: 1,

    init() {
        this.bindEvents();
    },

    bindEvents() {
        document.getElementById('decrease-qty')?.addEventListener('click', () => this.decrease());
        document.getElementById('increase-qty')?.addEventListener('click', () => this.increase());
    },

    decrease() {
        if (this.quantity > 1) {
            this.quantity--;
            this.updateDisplay();
        }
    },

    increase() {
        if (this.quantity < PRODUCT_CONFIG.maxQuantity) {
            this.quantity++;
            this.updateDisplay();
        }
    },

    updateDisplay() {
        const display = document.getElementById('qty-display');
        if (display) display.textContent = this.quantity;
    },

    get() {
        return this.quantity;
    }
};

// Date manager
const dateManager = {
    startDate: null,
    endDate: null,
    isVisible: false,

    init() {
        this.bindEvents();
        this.setMinDates();
    },

    bindEvents() {
        document.getElementById('select-date-btn')?.addEventListener('click', () => this.toggle());
        document.getElementById('start-date')?.addEventListener('change', (e) => this.setStart(e.target.value));
        document.getElementById('end-date')?.addEventListener('change', (e) => this.setEnd(e.target.value));
    },

    setMinDates() {
        const today = utils.getTodayDate();
        const startInput = document.getElementById('start-date');
        const endInput = document.getElementById('end-date');

        if (startInput) startInput.min = today;
        if (endInput) endInput.min = today;
    },

    toggle() {
        this.isVisible = !this.isVisible;
        const wrapper = document.getElementById('datepicker-wrapper');
        const button = document.getElementById('select-date-btn');

        wrapper?.classList.toggle('hidden', !this.isVisible);
        if (button) {
            button.textContent = this.isVisible ? 'Hide Date Selection' : 'Select Rental Date';
        }
    },

    setStart(dateString) {
        this.startDate = new Date(dateString);
        const endInput = document.getElementById('end-date');
        if (endInput) endInput.min = dateString;
    },

    setEnd(dateString) {
        this.endDate = new Date(dateString);
    },

    getDays() {
        if (this.startDate && this.endDate) {
            const timeDiff = this.endDate.getTime() - this.startDate.getTime();
            return Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
        }
        return 0;
    },

    isValid() {
        return this.startDate && this.endDate;
    }
};

// Delivery manager
const deliveryManager = {
    selectedOption: null,
    deliveryAddress: null,
    isVisible: false,

    init() {
        this.bindEvents();
    },

    bindEvents() {
        document.getElementById('select-delivery-btn')?.addEventListener('click', () => this.toggle());
        document.getElementById('pickup-option-btn')?.addEventListener('click', () => this.select('pickup'));
        document.getElementById('delivery-option-btn')?.addEventListener('click', () => this.select('delivery'));
        document.getElementById('save-delivery-address-btn')?.addEventListener('click', () => this.saveAddress());
    },

    toggle() {
        this.isVisible = !this.isVisible;
        const wrapper = document.getElementById('delivery-options-wrapper');
        const button = document.getElementById('select-delivery-btn');

        wrapper?.classList.toggle('hidden', !this.isVisible);
        if (button) {
            button.textContent = this.isVisible ? 'Hide Delivery Options' : 'Select Delivery Option';
        }
    },

    select(option) {
        this.selectedOption = option;

        // Update button states
        document.querySelectorAll('.delivery-option-btn').forEach(btn => {
            btn.classList.remove('border-[#6B549A]', 'bg-[#F8F4FF]');
            btn.classList.add('border-gray-300');
        });

        const selectedBtn = document.getElementById(`${option}-option-btn`);
        selectedBtn?.classList.remove('border-gray-300');
        selectedBtn?.classList.add('border-[#6B549A]', 'bg-[#F8F4FF]');

        // Show relevant sections
        const pickupInfo = document.getElementById('pickup-info');
        const deliveryForm = document.getElementById('delivery-address-form');

        if (option === 'pickup') {
            pickupInfo?.classList.remove('hidden');
            deliveryForm?.classList.add('hidden');
        } else {
            pickupInfo?.classList.add('hidden');
            deliveryForm?.classList.remove('hidden');
        }

        // Update button text
        const mainBtn = document.getElementById('select-delivery-btn');
        if (mainBtn) {
            mainBtn.textContent = `${option === 'pickup' ? 'Pick Up' : 'Delivery'} Selected`;
        }
    },

    saveAddress() {
        const address = document.getElementById('delivery-address')?.value.trim();
        const phone = document.getElementById('phone-number')?.value.trim();
        const name = document.getElementById('recipient-name')?.value.trim();

        if (!address || !phone || !name) {
            utils.showNotification('Please fill in all delivery information', 'warning');
            return;
        }

        this.deliveryAddress = {
            address,
            phone,
            name
        };
        utils.showNotification('Delivery address saved!', 'success');

        const saveBtn = document.getElementById('save-delivery-address-btn');
        if (saveBtn) {
            saveBtn.textContent = 'Address Saved ✓';
            saveBtn.classList.replace('bg-[#6B549A]', 'bg-green-600');
        }
    },

    isValid() {
        if (!this.selectedOption) return false;
        if (this.selectedOption === 'delivery' && !this.deliveryAddress) return false;
        return true;
    },

    getFee() {
        return this.selectedOption === 'delivery' ? 15000 : 0;
    }
};

// Tab manager
// Tab manager with improved positioning
const tabManager = {
    init() {
        // Add event listeners
        document.getElementById('description-btn')?.addEventListener('click', () => this.switchTab('description'));
        document.getElementById('details-btn')?.addEventListener('click', () => this.switchTab('details'));
        document.getElementById('specifications-btn')?.addEventListener('click', () => this.switchTab(
            'specifications'));

        // Set initial state
        this.setInitialState();
    },

    setInitialState() {
        // Ensure description is active by default
        this.switchTab('description');
    },

    switchTab(activeTabId) {
        // Get all tab contents and buttons
        const tabContents = document.querySelectorAll('.tab-content');
        const tabButtons = document.querySelectorAll('[id$="-btn"]');

        // Hide all tab contents with smooth transition
        tabContents.forEach(content => {
            content.classList.remove('opacity-100', 'pointer-events-auto');
            content.classList.add('opacity-0', 'pointer-events-none');
        });

        // Reset all button styles
        tabButtons.forEach(btn => {
            if (btn.id.includes('description') || btn.id.includes('details') || btn.id.includes(
                    'specifications')) {
                btn.classList.remove('border-[#2E1B5F]', 'text-[#2E1B5F]');
                btn.classList.add('border-transparent', 'text-[#8B7CC4]');
            }
        });

        // Show active tab content
        const activeTab = document.getElementById(activeTabId);
        if (activeTab) {
            setTimeout(() => {
                activeTab.classList.remove('opacity-0', 'pointer-events-none');
                activeTab.classList.add('opacity-100', 'pointer-events-auto');
            }, 150); // Small delay for smooth transition
        }

        // Style active button
        const activeButton = document.getElementById(activeTabId + '-btn');
        if (activeButton) {
            activeButton.classList.remove('border-transparent', 'text-[#8B7CC4]');
            activeButton.classList.add('border-[#2E1B5F]', 'text-[#2E1B5F]');
        }
    }
};

// Main controller
const productController = {
    init() {
        imageGallery.init();
        quantityController.init();
        dateManager.init();
        deliveryManager.init();
        tabManager.init();

        this.bindEvents();
    },

    bindEvents() {
        document.getElementById('add-to-cart-btn')?.addEventListener('click', () => this.addToCart());
        document.getElementById('rent-now-btn')?.addEventListener('click', () => this.rentNow());
    },

    validate() {
        const errors = [];

        if (!dateManager.isValid()) {
            errors.push('Please select rental dates');
        }

        if (!deliveryManager.isValid()) {
            errors.push('Please select delivery option and complete required information');
        }

        return errors;
    },

    addToCart() {
        const errors = this.validate();
        if (errors.length > 0) {
            errors.forEach(error => utils.showNotification(error, 'warning'));
            return;
        }

        const quantity = quantityController.get();
        const days = dateManager.getDays();
        
        // Show success message
        utils.showNotification(`${quantity} item(s) added to cart for ${days} day(s)!`, 'success');
        
        // Redirect to cart page after a short delay
        setTimeout(() => {
            window.location.href = "";
        }, 1500);
    },

    rentNow() {
        const errors = this.validate();
        if (errors.length > 0) {
            errors.forEach(error => utils.showNotification(error, 'warning'));
            return;
        }

        const quantity = quantityController.get();
        const days = dateManager.getDays();
        const basePrice = PRODUCT_CONFIG.price * quantity * days;
        const deliveryFee = deliveryManager.getFee();
        const total = basePrice + deliveryFee;

        // Show loading message
        utils.showNotification('Processing rental request...', 'info');

        // Optional: You can send data to session/server here before redirecting
        // For now, we'll just redirect to payment page
        setTimeout(() => {
            window.location.href = "{{ route('payment') }}";
        }, 1000);
    }
};

// Initialize when DOM loads
document.addEventListener('DOMContentLoaded', () => {
    productController.init();
});
</script>
@endsection