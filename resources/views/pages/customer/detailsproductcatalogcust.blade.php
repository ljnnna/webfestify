@extends('layouts.details')

@section('title', 'Details Product')

@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Home
    </a>
    <a href="{{ route('catalog') }}"
        class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Catalog
    </a>
    <a href="{{ route('team') }}"
        class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Team
    </a>
    <a href="{{ route('contact') }}"
        class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Contact
    </a>
</div>

@endsection

@section('content')
<!-- Main Content -->
<div class="bg-white max-w-[1100px] mx-auto px-4 sm:px-6 md:px-10 py-10 mt-4">
  <div class="flex flex-col md:flex-row gap-8">
    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
    @include('components.thumbnails')
        <!-- Product Information -->
        <section class="ml-12 flex-1 max-w-3xl">
            <h1 class="text-[#1A0041] font-extrabold text-3xl mb-2">{{ $product->name }}</h1>
            <p class="text-[#7F5CB2] text-2xl font-bold mb-8">Rp.{{ number_format($product->price, 0, ',', '.') }}/day</p>

            <!-- Quantity & Actions -->
            <div class="mb-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-[#6D5983] font-semibold">Quantity:</label>
                    <div class="flex items-center border-2 border-gray-200 rounded overflow-hidden w-32">
                        <button id="decrease-qty"
                            class="flex-1 py-2 text-xl text-[#6D5983] font-bold hover:bg-gray-50 transition-colors">-</button>
                        <span id="qty-display"
                            class="w-12 text-center py-2 text-lg font-semibold text-[#6D5983] border-x border-gray-300">1</span>
                        <button id="increase-qty"
                            class="flex-1 py-2 text-xl text-[#6D5983] font-bold hover:bg-gray-50 transition-colors">+</button>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button id="add-to-cart-btn"
                        class="bg-purple-100 border border-purple-500 text-purple-900 rounded px-6 py-3 font-semibold hover:bg-purple-50 transition-colors shadow">Add
                        To Cart</button>
                    <button id="rent-now-btn"
                        class="bg-purple-900 text-white rounded px-6 py-3 font-semibold hover:bg-[#1a0f3d] transition-colors shadow-lg">Rent
                        Now</button>
                </div>
            </div>

            <!-- Rental Date Selection -->
            <div class="mb-8">
                <button id="select-date-btn"
                    class="w-full bg-purple-100 border border-purple-500 text-purple-900 font-semibold rounded py-3 hover:bg-purple-50 transition-colors">Select
                    Rental Date</button>

                <div id="datepicker-wrapper" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4 hidden">
                    <div>
                        <label class="block text-[#6D5983] font-semibold mb-2">Start Date</label>
                        <input id="start-date" type="date"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-[#6D5983] focus:border-[#6B549A] transition-colors" />
                    </div>
                    <div>
                        <label class="block text-[#6D5983] font-semibold mb-2">End Date</label>
                        <input id="end-date" type="date"
                            class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 text-[#6D5983] focus:border-[#6B549A] transition-colors" />
                    </div>
                </div>
            </div>

            <!-- Delivery Option -->
            <div class="mb-8">
                <button id="select-delivery-btn"
                    class="w-full bg-purple-100 border border-purple-500 text-purple-900 font-semibold rounded py-3 hover:bg-purple-50 transition-colors">
                    Select Delivery Option
                </button>

                <div id="delivery-options-wrapper" class="mt-6 space-y-4 hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Pick Up -->
                        <button id="pickup-option-btn"
                            class="delivery-option-btn border-2 border-gray-300 rounded-lg p-4 text-left hover:border-[#6B549A] transition-colors">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-store text-[#6B549A]"></i>
                                <div>
                                    <div class="font-medium text-[#2E1B5F]">Pick Up</div>
                                    <div class="text-sm text-[#6D5983]">Free - Pick up at store</div>
                                </div>
                            </div>
                        </button>

                        <!-- Delivery -->
                        <button id="delivery-option-btn"
                            class="delivery-option-btn border-2 border-gray-300 rounded-lg p-4 text-left hover:border-[#6B549A] transition-colors">
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
                            <textarea id="delivery-address" rows="3"
                                class="w-full border-2 border-gray-300 rounded-lg p-3 text-[#6D5983] focus:border-[#6B549A] transition-colors resize-none"
                                placeholder="Enter complete address..."></textarea>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <input type="tel" id="phone-number"
                                    class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 text-[#6D5983] focus:border-[#6B549A] transition-colors"
                                    placeholder="Phone number" />
                                <input type="text" id="recipient-name"
                                    class="w-full border-2 border-gray-300 rounded-lg px-3 py-2 text-[#6D5983] focus:border-[#6B549A] transition-colors"
                                    placeholder="Recipient name" />
                            </div>
                            <button id="save-delivery-address-btn"
                                class="w-full bg-[#6B549A] text-white rounded-full py-2 font-semibold hover:bg-[#5a4788] transition-colors">Save
                                Address</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Tabs -->
            <div class="mt-6 sm:mt-10 border-t border-gray-300 pt-4 sm:pt-6">
                <div
                    class="flex flex-wrap sm:flex-nowrap space-x-4 sm:space-x-8 border-b border-gray-200 overflow-x-auto">
                    <button id="description-btn"
                        class="text-[#291757] font-bold pb-3 border-b-2 border-[#2E1B5F] transition-all duration-200 hover:text-[#291757] whitespace-nowrap">Description</button>
                    <button id="details-btn"
                        class="text-purple-900 font-bold pb-3 border-b-2 border-transparent hover:text-[#291757] transition-all duration-200 whitespace-nowrap">Details</button>
                    <button id="specifications-btn"
                        class="text-purple-900 font-bold pb-3 border-b-2 border-transparent hover:text-[#291757] transition-all duration-200 whitespace-nowrap">Specifications</button>
                </div>

                <!-- Tab Contents -->
                <div class="mt-4 sm:mt-6 relative min-h-[100px]">
                    <div id="description" class="tab-content opacity-100 transition-opacity duration-300">
                        <p class="text-[#6D5983] leading-relaxed text-sm sm:text-base">
                             {{ $product->description }}
                        </p>
                    </div>

                    <div id="details" class="tab-content opacity-100 transition-opacity duration-300">
                        <p class="text-[#6D5983] leading-relaxed text-sm sm:text-base">
                            {{ $product->details }}
                        </p>
                    </div>


                    <div id="specifications"
                        class="tab-content opacity-0 absolute inset-0 transition-opacity duration-300 pointer-events-none">
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


  </div>
</div>


        </section>
    </div>
</div>

@include('components.reviews')
@endsection

@section('scripts')
<script>
    
// Enhanced Utility functions with better notifications
const utils = {
    showNotification(message, type = 'info', duration = 5000, isInteractive = false) {
        // Remove existing notifications if interactive
        if (isInteractive) {
            document.querySelectorAll('.notification-alert').forEach(n => n.remove());
        }

        const notification = document.createElement('div');
        notification.className = `notification-alert fixed top-20 right-4 z-50 max-w-sm p-4 rounded-lg shadow-xl transform transition-all duration-500 ease-out ${
            type === 'success' ? 'bg-gradient-to-r from-green-500 to-green-600 text-white' :
            type === 'error' ? 'bg-gradient-to-r from-red-500 to-red-600 text-white' :
            type === 'warning' ? 'bg-gradient-to-r from-yellow-500 to-orange-500 text-white' :
            'bg-gradient-to-r from-blue-500 to-blue-600 text-white'
        } animate-slide-in`;

        const iconMap = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-triangle',
            warning: 'fas fa-exclamation-circle',
            info: 'fas fa-info-circle'
        };

        notification.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 mt-0.5">
                    <i class="${iconMap[type]} text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold mb-1">${this.getNotificationTitle(type)}</div>
                    <div class="text-sm opacity-90 leading-relaxed">${message}</div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" 
                        class="flex-shrink-0 ml-2 text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            ${isInteractive ? `
                <div class="mt-3 pt-3 border-t border-white border-opacity-30">
                    <div class="flex gap-2">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                class="flex-1 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-xs font-medium py-2 px-3 rounded-md transition-colors">
                            Dismiss
                        </button>
                        ${type === 'warning' ? `
                            <button onclick="dateManager.showDateHelper(); this.parentElement.parentElement.parentElement.remove()" 
                                    class="flex-1 bg-white text-gray-800 hover:bg-gray-100 text-xs font-medium py-2 px-3 rounded-md transition-colors">
                                Fix Dates
                            </button>
                        ` : ''}
                    </div>
                </div>
            ` : ''}
        `;

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            .animate-slide-in {
                animation: slideIn 0.5s ease-out;
            }
            .notification-alert {
                backdrop-filter: blur(10px);
            }
        `;
        document.head.appendChild(style);

        document.body.appendChild(notification);

        // Auto remove after duration
        if (duration > 0) {
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                notification.style.opacity = '0';
                setTimeout(() => notification.remove(), 300);
            }, duration);
        }
    },

    getNotificationTitle(type) {
        const titles = {
            success: 'Success!',
            error: 'Error!',
            warning: 'Warning!',
            info: 'Information'
        };
        return titles[type] || 'Notification';
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
    },

    addDaysToDate(dateString, days) {
        const date = new Date(dateString);
        date.setDate(date.getDate() + days);
        return date.toISOString().split('T')[0];
    }
};
 
const quantityController = {
    quantity: 1,
    decreaseBtn: null,
    increaseBtn: null,
    display: null,

    init() {
        this.decreaseBtn = document.getElementById('decrease-qty');
        this.increaseBtn = document.getElementById('increase-qty');
        this.display = document.getElementById('qty-display');

        if (this.decreaseBtn && this.increaseBtn && this.display) {
            // Hapus event listener lama jika ada (opsional, tapi aman)
            this.decreaseBtn.replaceWith(this.decreaseBtn.cloneNode(true));
            this.increaseBtn.replaceWith(this.increaseBtn.cloneNode(true));

            // Ambil ulang elemen setelah replace
            this.decreaseBtn = document.getElementById('decrease-qty');
            this.increaseBtn = document.getElementById('increase-qty');

            this.bindEvents();
            this.updateDisplay();
        } else {
            console.warn('Quantity elements not found in DOM');
        }
    },

    bindEvents() {
        this.decreaseBtn.addEventListener('click', () => this.decrease());
        this.increaseBtn.addEventListener('click', () => this.increase());
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
        this.display.textContent = this.quantity;
    },

    get() {
        return this.quantity;
    }
};

document.addEventListener('DOMContentLoaded', function () {
    quantityController.init();
    imageGallery.init();
});


// Enhanced Date manager with 7-day limit
const dateManager = {
    startDate: null,
    endDate: null,
    isVisible: false,

    init() {
        this.bindEvents();
        this.setMinDates();
        this.addDateHelper();
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

    addDateHelper() {
        const wrapper = document.getElementById('datepicker-wrapper');
        if (wrapper) {
            const helper = document.createElement('div');
            helper.className = 'mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-800';
            helper.innerHTML = `
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-info-circle"></i>
                    <span class="font-semibold">Rental Information</span>
                </div>
                <ul class="space-y-1 text-xs">
                    <li>• Maximum rental period: <strong>7 days</strong></li>
                    <li>• Start date cannot be in the past</li>
                    <li>• End date must be after start date</li>
                </ul>
            `;
            wrapper.appendChild(helper);
        }
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
        
        if (endInput) {
            endInput.min = dateString;
            
            // Auto-set max end date to 7 days from start
            const maxEndDate = utils.addDaysToDate(dateString, PRODUCT_CONFIG.maxRentalDays - 1);
            endInput.max = maxEndDate;
            
            // Reset end date if it exceeds the limit
            if (this.endDate && this.getDays() > PRODUCT_CONFIG.maxRentalDays) {
                endInput.value = maxEndDate;
                this.setEnd(maxEndDate);
                utils.showNotification(
                    `End date adjusted to maximum ${PRODUCT_CONFIG.maxRentalDays} days rental period`,
                    'warning',
                    4000,
                    true
                );
            }
        }
        
        this.updateRentalSummary();
    },

    setEnd(dateString) {
        this.endDate = new Date(dateString);
        
        // Validate rental period
        const days = this.getDays();
        if (days > PRODUCT_CONFIG.maxRentalDays) {
            const maxEndDate = utils.addDaysToDate(
                document.getElementById('start-date').value, 
                PRODUCT_CONFIG.maxRentalDays - 1
            );
            
            document.getElementById('end-date').value = maxEndDate;
            this.endDate = new Date(maxEndDate);
            
            utils.showNotification(
                `Maximum rental period is ${PRODUCT_CONFIG.maxRentalDays} days. End date has been adjusted automatically.`,
                'warning',
                6000,
                true
            );
        }
        
        this.updateRentalSummary();
    },

    updateRentalSummary() {
        const summary = document.getElementById('rental-summary');
        const details = document.getElementById('rental-details');
        
        if (this.startDate && this.endDate && summary && details) {
            const days = this.getDays();
            const quantity = quantityController.get();
            const totalCost = PRODUCT_CONFIG.price * quantity * days;
            
            summary.classList.remove('hidden');
            details.innerHTML = `
                <div class="flex justify-between">
                    <span>Duration:</span>
                    <span class="font-medium">${days} day${days > 1 ? 's' : ''}</span>
                </div>
                <div class="flex justify-between">
                    <span>Quantity:</span>
                    <span class="font-medium">${quantity} item${quantity > 1 ? 's' : ''}</span>
                </div>
                <div class="flex justify-between border-t pt-1 mt-1">
                    <span>Subtotal:</span>
                    <span class="font-medium">${utils.formatPrice(totalCost)}</span>
                </div>
            `;
        } else if (summary) {
            summary.classList.add('hidden');
        }
    },

    showDateHelper() {
        this.toggle();
        if (this.isVisible) {
            document.getElementById('start-date')?.focus();
        }
    },

    getDays() {
        if (this.startDate && this.endDate) {
            const timeDiff = this.endDate.getTime() - this.startDate.getTime();
            return Math.ceil(timeDiff / (1000 * 3600 * 24)) + 1;
        }
        return 0;
    },

    isValid() {
        if (!this.startDate || !this.endDate) return false;
        
        const days = this.getDays();
        return days > 0 && days <= PRODUCT_CONFIG.maxRentalDays;
    },

    getValidationError() {
        if (!this.startDate || !this.endDate) {
            return 'Please select both start and end dates';
        }
        
        const days = this.getDays();
        if (days <= 0) {
            return 'End date must be after start date';
        }
        
        if (days > PRODUCT_CONFIG.maxRentalDays) {
            return `Rental period cannot exceed ${PRODUCT_CONFIG.maxRentalDays} days`;
        }
        
        return null;
    }
};

// Enhanced Delivery manager with better validation
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
            utils.showNotification('Pickup option selected. Please note store hours!', 'success', 3000);
        } else {
            pickupInfo?.classList.add('hidden');
            deliveryForm?.classList.remove('hidden');
            utils.showNotification('Please fill in your delivery address below', 'info', 3000);
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
            utils.showNotification(
                'Please fill in all delivery information: address, phone number, and recipient name',
                'warning',
                5000,
                true
            );
            return;
        }

        // Basic phone validation
        if (!/^\d{10,13}$/.test(phone.replace(/\D/g, ''))) {
            utils.showNotification(
                'Please enter a valid phone number (10-13 digits)',
                'warning',
                4000,
                true
            );
            return;
        }

        this.deliveryAddress = { address, phone, name };
        utils.showNotification('Delivery address saved successfully!', 'success', 3000);

        const saveBtn = document.getElementById('save-delivery-address-btn');
        if (saveBtn) {
            saveBtn.textContent = 'Address Saved ✓';
            saveBtn.classList.replace('bg-[#6B549A]', 'bg-green-600');
            saveBtn.classList.replace('hover:bg-[#5a4788]', 'hover:bg-green-700');
        }
    },

    isValid() {
        if (!this.selectedOption) return false;
        if (this.selectedOption === 'delivery' && !this.deliveryAddress) return false;
        return true;
    },

    getValidationError() {
        if (!this.selectedOption) {
            return 'Please select a delivery option (pickup or delivery)';
        }
        if (this.selectedOption === 'delivery' && !this.deliveryAddress) {
            return 'Please complete delivery address information';
        }
        return null;
    },

    getFee() {
        return this.selectedOption === 'delivery' ? 15000 : 0;
    }
};

// Tab manager (unchanged)
const tabManager = {
    init() {
        document.getElementById('description-btn')?.addEventListener('click', () => this.switchTab('description'));
        document.getElementById('details-btn')?.addEventListener('click', () => this.switchTab('details'));
        document.getElementById('specifications-btn')?.addEventListener('click', () => this.switchTab('specifications'));
        this.setInitialState();
    },

    setInitialState() {
        this.switchTab('description');
    },

    switchTab(activeTabId) {
        const tabContents = document.querySelectorAll('.tab-content');
        const tabButtons = document.querySelectorAll('[id$="-btn"]');

        tabContents.forEach(content => {
            content.classList.remove('opacity-100', 'pointer-events-auto');
            content.classList.add('opacity-0', 'pointer-events-none');
        });

        tabButtons.forEach(btn => {
            if (btn.id.includes('description') || btn.id.includes('details') || btn.id.includes('specifications')) {
                btn.classList.remove('border-[#2E1B5F]', 'text-[#2E1B5F]');
                btn.classList.add('border-transparent', 'text-[#8B7CC4]');
            }
        });

        const activeTab = document.getElementById(activeTabId);
        if (activeTab) {
            setTimeout(() => {
                activeTab.classList.remove('opacity-0', 'pointer-events-none');
                activeTab.classList.add('opacity-100', 'pointer-events-auto');
            }, 150);
        }

        const activeButton = document.getElementById(activeTabId + '-btn');
        if (activeButton) {
            activeButton.classList.remove('border-transparent', 'text-[#8B7CC4]');
            activeButton.classList.add('border-[#2E1B5F]', 'text-[#2E1B5F]');
        }
    }
};

// Enhanced Main controller with better validation
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

        // Validate dates
        const dateError = dateManager.getValidationError();
        if (dateError) {
            errors.push(dateError);
        }

        // Validate delivery
        const deliveryError = deliveryManager.getValidationError();
        if (deliveryError) {
            errors.push(deliveryError);
        }

        return errors;
    },

    addToCart() {
        const errors = this.validate();
        if (errors.length > 0) {
            errors.forEach((error, index) => {
                setTimeout(() => {
                    utils.showNotification(error, 'warning', 6000, true);
                }, index * 500);
            });
            return;
        }

        const quantity = quantityController.get();
        const days = dateManager.getDays();

        utils.showNotification(
            `${quantity} item(s) added to cart for ${days} day(s)! Redirecting to cart...`,
            'success',
            3000
        );

        setTimeout(() => {
            window.location.href = "/cart";
        }, 2000);
    },

    rentNow() {
        const errors = this.validate();
        if (errors.length > 0) {
            errors.forEach((error, index) => {
                setTimeout(() => {
                    utils.showNotification(error, 'warning', 6000, true);
                }, index * 500);
            });
            return;
        }

        const quantity = quantityController.get();
        const days = dateManager.getDays();
        const basePrice = PRODUCT_CONFIG.price * quantity * days;
        const deliveryFee = deliveryManager.getFee();
        const total = basePrice + deliveryFee;

        utils.showNotification(
            `Processing rental request for ${utils.formatPrice(total)}...`,
            'info',
            2000
        );

        setTimeout(() => {
            window.location.href = "/payment";
        }, 1500);
    }
};

// Initialize when DOM loads
document.addEventListener('DOMContentLoaded', () => {
    productController.init();
});
</script>
@endsection