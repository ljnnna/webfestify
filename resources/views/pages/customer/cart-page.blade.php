@extends('layouts.cart')

@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Home</a>
    <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Catalog</a>
    <a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Team</a>
    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Contact</a>
</div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="w-full p-6 sm:p-8 bg-gray-50">
        <div class="flex items-center gap-3 mb-6">
            <img src="{{ asset('images/logofestify.png') }}" class="h-8 w-auto" alt="Festify Logo" />
            <h2 class="text-2xl font-semibold text-gray-800">Your Shopping Cart</h2>
        </div>

        {{-- Header Table --}}
        <div class="hidden sm:block bg-white border border-black rounded mb-8 px-3 py-2 shadow-sm">
            <div class="text-sm font-semibold text-gray-600">
                <div class="whitespace-nowrap">
                    <div style="display: inline-block; width: 42%;">
                        <label class="inline-flex items-center gap-2">
                            <input type="checkbox" id="select-all" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                            <span>Product</span>
                        </label>
                    </div>
                    <div style="display: inline-block; width: 18%; text-align: mr-16 center;">
                        Price/Day
                    </div>
                    <div style="display: inline-block; width: 20%; text-align: center; margin-left: 1.5rem;">
                        Quantity 
                    </div>
                    <div style="display: inline-block; width: 18%; text-align: center; margin-left: 4rem;">
                        Action
                    </div>
                </div>
            </div>
        </div>

        {{-- Cart Items --}}
        @php $cart = $cart ?? collect(); @endphp
        @if($cart->count() > 0)
<div class="space-y-4">
    @foreach($cart as $item)
        @php
            $product = $item->product;
            $slug = $product->slug;
        @endphp
    <div class="relative group cart-item bg-gradient-to-r from-purple-50 to-pink-50 rounded p-4 shadow overflow-hidden"
        data-price="{{ $product->price }}" data-base-price="{{ $product->price }}" data-delivery="{{ $item->delivery_option }}">

        {{-- Link overlay seluruh card --}}
        <a href="{{ route('product.show', $slug) }}" class="absolute inset-0 z-0"></a>

        <div class="relative z-10 flex flex-col sm:grid sm:grid-cols-5 gap-3 sm:gap-4">
            <div class="flex items-start gap-3 sm:col-span-2 sm:items-center">
                <input type="checkbox"
                    class="item-check relative z-20 w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500 mt-1 sm:mt-0">
                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}"
                    class="relative z-10 w-24 h-24 object-cover rounded pointer-events-none" />
                <div>
                    <h3 class="font-semibold text-gray-800 text-sm sm:text-base">{{ $product->name }}</h3>
                    <p class="text-xs sm:text-sm text-gray-600">{{ $product->version ?? '' }}</p>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-row sm:col-span-3 sm:items-center sm:justify-between gap-2 sm:gap-0">
                <div class="text-sm text-gray-700 sm:text-center min-w-[100px]">
                    <span class="font-semibold item-total-price block">IDR {{ number_format($product->price) }}</span>
                    <span class="text-xs text-gray-500">
                        IDR {{ number_format($product->price) }}/day × {{ $item->quantity }}
                    </span>
                </div>

                <div class="flex justify-center items-center z-20">
                    <span class="count text-sm text-gray-800 font-medium">{{ $item->quantity }}</span>
                </div>


                <div class="flex justify-end sm:justify-center min-w-[40px] z-20">
                    <form action="{{ route('cart.remove', $slug) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="remove text-red-500 hover:text-red-700 transition-colors p-2">
                            <i class="fas fa-trash text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
    <div class="text-center py-10 text-gray-500">Your cart is empty.</div>
@endif


        {{-- Order Summary --}}
        <div class="mt-8">
            <div class="bg-white rounded p-6 shadow-lg border border-black">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-calculator text-purple-600"></i> Order Summary
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between text-sm"><span class="text-gray-600">Items</span><span id="item-count" class="font-medium text-gray-800">0 items</span></div>
                    <div class="flex justify-between text-sm"><span class="text-gray-600">Subtotal</span><span id="item-subtotal" class="font-medium text-gray-800">IDR 0</span></div>
                    <div class="flex justify-between text-sm"><span class="text-gray-600">Service Fee</span><span class="font-medium text-gray-800">IDR 5,000</span></div>
                    <div class="flex justify-between text-sm"><span class="text-gray-600">Delivery Fee</span><span id="delivery-fee-display" class="font-medium text-gray-800">IDR 0</span></div>
                    <hr class="border-purple-200">
                    <div class="flex justify-between items-center text-base font-semibold">
                        <span class="text-gray-800">Total Amount</span>
                        <span id="total-price" class="text-purple-600 text-lg">IDR 0</span>
                    </div>
                </div>
                <div class="mt-6">
                <form method="POST" action="{{ route('checkout.process') }}" id="checkout-form">

    @csrf
    <input type="hidden" name="selected_cart_ids" id="selected_cart_ids">
    <button type="submit"
        class="block w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white py-3 px-4 rounded-lg font-semibold text-center hover:from-purple-700 hover:to-indigo-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
        <i class="fas fa-shopping-cart mr-2"></i> Proceed to Checkout
    </button>
</form>


                </div>
            </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const selectAll = document.getElementById('select-all');
    const itemChecks = document.querySelectorAll('.item-check');

    function updateItemPriceDisplay(item) {
        const count = parseInt(item.querySelector('.count').innerText);
        const basePrice = parseInt(item.getAttribute('data-base-price'));
        const totalPrice = basePrice * count;

        item.querySelector('.item-total-price').innerText = `IDR ${totalPrice.toLocaleString()}`;
        item.setAttribute('data-price', totalPrice);
    }

    function updateSummary() {
    let items = document.querySelectorAll('.cart-item');
    let subtotal = 0, itemCount = 0;
    let hasDelivery = false;

    items.forEach(item => {
        const checkbox = item.querySelector('.item-check');
        const count = parseInt(item.querySelector('.count').innerText);
        const basePrice = parseInt(item.getAttribute('data-base-price'));
        const deliveryOption = item.getAttribute('data-delivery');

        if (checkbox.checked) {
            subtotal += basePrice * count;
            itemCount += count;
            if (deliveryOption === 'delivery') {
                hasDelivery = true;
            }
        }
    });

    const serviceFee = 5000;
    const deliveryFee = hasDelivery ? 10000 : 0;
    const total = subtotal + serviceFee + deliveryFee;

    document.getElementById('item-count').innerText = `${itemCount} items`;
    document.getElementById('item-subtotal').innerText = `IDR ${subtotal.toLocaleString()}`;
    document.getElementById('delivery-fee-display').innerText = `IDR ${deliveryFee.toLocaleString()}`;
    document.getElementById('total-price').innerText = `IDR ${total.toLocaleString()}`;
}


    // document.querySelectorAll('.increment').forEach(btn => {
    //     btn.addEventListener('click', e => {
    //         const item = e.target.closest('.cart-item');
    //         const countEl = item.querySelector('.count');
    //         let count = parseInt(countEl.innerText) + 1;
    //         countEl.innerText = count;
    //         updateItemPriceDisplay(item);
    //         updateSummary();
    //     });
    // });

    // document.querySelectorAll('.decrement').forEach(btn => {
    //     btn.addEventListener('click', e => {
    //         const item = e.target.closest('.cart-item');
    //         const countEl = item.querySelector('.count');
    //         let count = parseInt(countEl.innerText);
    //         if (count > 1) {
    //             countEl.innerText = count - 1;
    //             updateItemPriceDisplay(item);
    //             updateSummary();
    //         }
    //     });
    // });

    document.querySelectorAll('.remove').forEach(btn => {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            if (confirm('Are you sure you want to remove this item?')) {
                this.closest('form').submit();
            }
        });
    });

    itemChecks.forEach(cb => cb.addEventListener('change', function () {
    updateSummary();

    // Sync status selectAll berdasarkan semua item
    const allChecked = Array.from(itemChecks).every(item => item.checked);
    if (selectAll) {
        selectAll.checked = allChecked;
    }
    }));

    if (selectAll) {
        selectAll.addEventListener('change', () => {
            itemChecks.forEach(cb => cb.checked = selectAll.checked);
            updateSummary();
        });
    }

    // Default check semua
    itemChecks.forEach(cb => cb.checked = true);
    if (selectAll) selectAll.checked = true;

    document.querySelectorAll('.cart-item').forEach(updateItemPriceDisplay);
    updateSummary();
});
</script>

@endsection
