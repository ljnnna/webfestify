<!-- Order Details Section -->
<section class="space-y-6">
    <header>
        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#5B4B7A] pb-4 border-b border-gray-300">
            ORDER DETAILS
        </h1>
    </header>

    <!-- Product Information Card -->
    <article class="bg-white rounded-xl shadow-sm p-4 sm:p-6 space-y-4 hover-lift transition-smooth">
        <!-- Product Display -->
        <div class="flex flex-col sm:flex-row gap-4">
    <img alt="{{ $paymentData['product']->name }}"
        class="w-full sm:w-20 h-40 sm:h-20 rounded-lg object-cover flex-shrink-0 shadow-sm"
        src="{{ asset('storage/' . $paymentData['product']->images->first()->path) }}" />

    <div class="flex flex-col justify-center text-[#4B3B6B] space-y-1">
        <h2 class="font-semibold text-base sm:text-lg">{{ $paymentData['product']->name }}</h2>
        <p class="text-sm text-gray-600">Qty: {{ $paymentData['rental_data']['quantity'] }}</p>
        <p class="font-semibold text-sm">
            Rental Period: <span class="font-normal">{{ $paymentData['rental_data']['rental_days'] }} Days</span>
        </p>
    </div>
</div>

<!-- Product Description -->
<p class="text-[#4B3B6B] text-sm leading-relaxed">
    {{ Str::limit($paymentData['product']->description, 100) }}
</p>

<!-- Price Breakdown -->
<div class="border-t border-gray-300 pt-4 space-y-2 text-[#4B3B6B] text-sm">
    <div class="flex justify-between">
        <span>Sub Total</span>
        <span class="font-semibold">Rp. {{ number_format($paymentData['pricing']['subtotal'], 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between">
        <span>Service Fee</span>
        <span class="font-semibold">Rp. {{ number_format($paymentData['pricing']['service_fee'], 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between">
        <span>Deposit (50%)</span>
        <span class="font-semibold">Rp. {{ number_format($paymentData['pricing']['deposit'], 0, ',', '.') }}</span>
    </div>
    @if($paymentData['pricing']['shipping_cost'] > 0)
    <div class="flex justify-between">
        <span>Shipping Costs</span>
        <span class="font-semibold">Rp. {{ number_format($paymentData['pricing']['shipping_cost'], 0, ',', '.') }}</span>
    </div>
    @endif
</div>

<!-- Total Amount -->
<div class="border-t border-gray-300 pt-4 flex justify-between font-extrabold text-[#5B4B7A] text-lg">
    <span>Total</span>
    <span>Rp. {{ number_format($paymentData['pricing']['total'], 0, ',', '.') }}</span>
</div>
    </article>
</section>