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
                <p class="text-sm text-gray-600">
                    Dates: {{ \Carbon\Carbon::parse($paymentData['rental_data']['start_date'])->format('d M Y') }} - 
                    {{ \Carbon\Carbon::parse($paymentData['rental_data']['end_date'])->format('d M Y') }}
                </p>
            </div>
        </div>

        <!-- Product Description -->
        <p class="text-[#4B3B6B] text-sm leading-relaxed">
            {{ Str::limit($paymentData['product']->description, 100) }}
        </p>

        <!-- Delivery Information -->
        <div class="border-t border-gray-300 pt-4">
            <h3 class="font-semibold text-[#5B4B7A] mb-2">Delivery Information</h3>
            
            @if($paymentData['rental_data']['delivery_option'] === 'pickup')
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fas fa-store text-blue-600"></i>
                        <span class="font-medium text-blue-800">Pick Up at Store</span>
                    </div>
                    <div class="text-sm text-blue-700 space-y-1">
                        <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Ahmad Yani, Batam Center, Batam</p>
                        <p><i class="fas fa-clock mr-2"></i>Monday - Friday, 08:00 - 17:00</p>
                    </div>
                </div>
            @else
                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fas fa-truck text-green-600"></i>
                        <span class="font-medium text-green-800">Delivery Service</span>
                    </div>
                    <div class="text-sm text-green-700 space-y-1">
                        <p><strong>Recipient:</strong> {{ $paymentData['rental_data']['recipient_name'] }}</p>
                        <p><strong>Phone:</strong> {{ $paymentData['rental_data']['phone_number'] }}</p>
                        <p><strong>Address:</strong> {{ $paymentData['rental_data']['delivery_address'] }}</p>
                        <p class="text-xs text-green-600 mt-2">
                            <i class="fas fa-info-circle mr-1"></i>
                            Shipping Costs: Rp. {{ number_format($paymentData['pricing']['shipping_cost'], 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            @endif
        </div>

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