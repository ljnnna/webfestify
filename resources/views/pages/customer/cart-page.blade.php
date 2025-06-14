@extends('layouts.cart')

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
<div class="min-h-screen bg-gray-50">
    <!-- Cart Items Section -->
    <div class="w-full p-6 sm:p-8 bg-gray-50">
        <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('images/logofestify.png') }}" class="h-8 w-auto" alt="Festify Logo" />
            <h2 class="text-2xl font-semibold text-gray-800">Your Shopping Cart</h2>
        </div>

        <!-- Cart Header -->
        <div class="hidden sm:block  bg-white border border-black rounded mb-8 px-3 py-2 shadow-sm">
            <div class="text-sm font-semibold text-gray-600">
                <div class="whitespace-nowrap">
                    <!-- Product (Checkbox + Label) -->
                    <div style="display: inline-block; width: 42%; vertical-align: middle;">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" id="select-all" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <span>Product</span>
                        </label>
                    </div>

                    <!-- Price/Day -->
                    <div style="display: inline-block; width: 18%; text-align: mr-16 center;">
                        Price/Day
                    </div>

                    <!-- Quantity  -->
                    <div style="display: inline-block; width: 20%; text-align: center; margin-left: 1.5rem;">
                        Quantity 
                    </div>

                    <!-- Action -->
                    <div style="display: inline-block; width: 18%; text-align: center; margin-left: 4rem;">
                        Action
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Items -->
        @php
            $items = [
                ['id' => 1, 'image' => 'lightstick.png', 'name' => 'Lightstick Seventeen', 'version' => 'Ver.2', 'price' => 25000],
                ['id' => 2, 'image' => 'kursi.png', 'name' => 'Premium Chair', 'version' => 'Comfort Series', 'price' => 50000],
                ['id' => 3, 'image' => 'kamera.png', 'name' => 'Professional Camera', 'version' => 'Pro Max', 'price' => 75000],
            ];
        @endphp

        <div class="space-y-4">
            @foreach($items as $item)
            <div class="cart-item bg-gradient-to-r from-purple-50 to-pink-50 rounded p-4 shadow" data-price="{{ $item['price'] }}" data-base-price="{{ $item['price'] }}">
                <div class="flex flex-col sm:grid sm:grid-cols-5 gap-3 sm:gap-4">
                    <!-- BARIS 1 -->
                    <div class="flex items-start gap-3 sm:col-span-2 sm:items-center">
                        <input type="checkbox" class="item-check w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500 mt-1 sm:mt-0">
                        <img src="/images/{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-16 h-16 object-cover rounded-lg shadow-sm">
                        <div>
                            <h3 class="font-semibold text-gray-800 text-sm sm:text-base">{{ $item['name'] }}</h3>
                            <p class="text-xs sm:text-sm text-gray-600">{{ $item['version'] }}</p>
                        </div>
                    </div>

                    <!-- BARIS 2: Harga, Qty, Trash icon dalam satu baris di mobile -->
                    <div class="flex flex-wrap sm:flex-row sm:col-span-3 sm:items-center sm:justify-between gap-2 sm:gap-0">
                        <!-- Price -->
                        <div class="text-sm text-gray-700 sm:text-center min-w-[100px]">
                            <span class="font-semibold item-total-price block">IDR {{ number_format($item['price']) }}</span>
                            <span class="text-xs text-gray-500">
                                IDR {{ number_format($item['price']) }}/day × <span class="qty-display">1</span>
                            </span>
                        </div>

                        <!-- Quantity Control -->
                        <div class="flex justify-center">
                            <div class="flex items-center border border-gray-300 rounded-lg bg-white text-sm">
                                <button class="decrement px-3 py-1.5 text-gray-600 hover:text-purple-600 transition-colors">
                                    <i class="fas fa-minus text-sm"></i>
                                </button>
                                <span class="count px-4 py-1.5 font-semibold text-gray-800">1</span>
                                <button class="increment px-3 py-1.5 text-gray-600 hover:text-purple-600 transition-colors">
                                    <i class="fas fa-plus text-sm"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Trash Icon -->
                        <div class="flex justify-end sm:justify-center min-w-[40px]">
                            <button class="remove text-red-500 hover:text-red-700 transition-colors p-2">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Order Summary Section -->
        <div class="mt-8">
            <div class="bg-white rounded p-6 shadow-lg border border-black">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-calculator text-purple-600"></i>
                    Order Summary
                </h3>
                
                <div class="space-y-3">
                    <!-- Items Count -->
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600">Items</span>
                        <span id="item-count" class="font-medium text-gray-800">3 items</span>
                    </div>
                    
                    <!-- Subtotal -->
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600">Subtotal</span>
                        <span id="item-subtotal" class="font-medium text-gray-800">IDR 150,000</span>
                    </div>
                    
                    <!-- Service Fee -->
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600">Service Fee</span>
                        <span class="font-medium text-gray-800">IDR 5,000</span>
                    </div>
                    
                    <!-- Divider -->
                    <hr class="border-purple-200">
                    
                    <!-- Total -->
                    <div class="flex justify-between items-center text-base font-semibold">
                        <span class="text-gray-800">Total Amount</span>
                        <span id="total-price" class="text-purple-600 text-lg">IDR 155,000</span>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="mt-6 space-y-3">
                    <a href="{{ route('payment') }}" class="block w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-4 rounded-lg font-semibold hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-center">
                        <i class="fas fa-shopping-cart mr-2"></i>
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('select-all');
    const itemChecks = document.querySelectorAll('.item-check');

    function updateItemPriceDisplay(item) {
        const count = parseInt(item.querySelector('.count').innerText);
        const basePrice = parseInt(item.getAttribute('data-base-price'));
        const totalPrice = basePrice * count;
        
        // Update the displayed price for this item
        item.querySelector('.item-total-price').innerText = `IDR ${totalPrice.toLocaleString()}`;
        item.querySelector('.qty-display').innerText = count;
        
        // Update the data-price attribute for summary calculation
        item.setAttribute('data-price', totalPrice);
    }

    function updateSummary() {
        let items = document.querySelectorAll('.cart-item');
        let subtotal = 0, itemCount = 0, selectedCount = 0;

        items.forEach(item => {
            const checkbox = item.querySelector('.item-check');
            const count = parseInt(item.querySelector('.count').innerText);
            const basePrice = parseInt(item.getAttribute('data-base-price'));
            const totalPrice = basePrice * count;

            if (checkbox.checked) {
                subtotal += totalPrice;
                itemCount += count;
                selectedCount++;
            }
        });

        const serviceFee = 5000;
        const total = subtotal + serviceFee;

        document.getElementById('item-count').innerText = `${itemCount} items`;
        document.getElementById('item-subtotal').innerText = `IDR ${subtotal.toLocaleString()}`;
        document.getElementById('total-price').innerText = `IDR ${total.toLocaleString()}`;
    }

    // Quantity controls
    document.querySelectorAll('.increment').forEach(btn => {
        btn.addEventListener('click', e => {
            const item = e.target.closest('.cart-item');
            const countEl = item.querySelector('.count');
            const newCount = parseInt(countEl.innerText) + 1;
            
            countEl.innerText = newCount;
            updateItemPriceDisplay(item);
            updateSummary();
        });
    });

    document.querySelectorAll('.decrement').forEach(btn => {
        btn.addEventListener('click', e => {
            const item = e.target.closest('.cart-item');
            const countEl = item.querySelector('.count');
            let count = parseInt(countEl.innerText);
            
            if (count > 1) {
                const newCount = count - 1;
                countEl.innerText = newCount;
                updateItemPriceDisplay(item);
                updateSummary();
            }
        });
    });

    // Remove item
    document.querySelectorAll('.remove').forEach(btn => {
        btn.addEventListener('click', e => {
            if (confirm('Are you sure you want to remove this item?')) {
                e.target.closest('.cart-item').remove();
                updateSummary();
                updateSelectAllState();
            }
        });
    });

    // Individual checkbox change
    itemChecks.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            updateSummary();
            updateSelectAllState();
        });
    });

    // Select all functionality
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            const currentItemChecks = document.querySelectorAll('.item-check');
            currentItemChecks.forEach(cb => cb.checked = selectAll.checked);
            updateSummary();
        });
    }

    function updateSelectAllState() {
        const currentItemChecks = document.querySelectorAll('.item-check');
        const allChecked = currentItemChecks.length > 0 && Array.from(currentItemChecks).every(c => c.checked);
        if (selectAll) selectAll.checked = allChecked;
    }

    // Initialize all item price displays and summary
    document.querySelectorAll('.cart-item').forEach(item => {
        updateItemPriceDisplay(item);
    });
    updateSummary();
});
</script>
@endsection