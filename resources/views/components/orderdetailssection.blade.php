{{-- Ambil items --}}

@php

    use Illuminate\Support\Str;

    if (isset($paymentData['cart_items'])) {
        $items = $paymentData['cart_items'];
    } elseif (isset($cartItems)) {
        $items = $cartItems;
    } elseif (isset($paymentData['product'], $paymentData['rental_data'])) {
        $product = $paymentData['product'];
        $rental = (object) $paymentData['rental_data'];
        $rental->product = $product;
        $rental->quantity = $rental->quantity ?? 1;
        $rental->rental_days = $rental->rental_days ?? 1;
        $items = [$rental];
    } else {
        $items = [];
    }
@endphp

{{-- Loop setiap item --}}
@foreach($items as $item)
    @php
        // Hitung rental_days hanya jika belum ada
        $rental_days = $item->rental_days ?? (
            isset($item->start_date, $item->end_date)
                ? \Carbon\Carbon::parse($item->start_date)->diffInDays(\Carbon\Carbon::parse($item->end_date)) + 1
                : 1
        );

        // Cek dan ambil data delivery jika ada
        if (isset($item->delivery_details) && is_string($item->delivery_details)) {
            $details = json_decode($item->delivery_details, true);
            $item->recipient_name = $details['recipient_name'] ?? '-';
            $item->phone_number = $details['phone'] ?? '-';
            $item->delivery_address = $details['address'] ?? '-';
        }

        // Fallback kalau tetap belum ada
        $item->recipient_name = $item->recipient_name ?? '-';
        $item->phone_number = $item->phone_number ?? '-';
        $item->delivery_address = $item->delivery_address ?? '-';
    @endphp



    <article class="bg-white rounded-xl shadow-sm p-4 sm:p-6 space-y-4 hover-lift transition-smooth mb-6">
        <div class="flex flex-col sm:flex-row gap-4">
            <img alt="{{ $item->product->name }}"
                class="w-full sm:w-20 h-40 sm:h-20 rounded-lg object-cover flex-shrink-0 shadow-sm"
                src="{{ $item->product->main_image_url }}" />

            <div class="flex flex-col justify-center text-[#4B3B6B] space-y-1">
                <h2 class="font-semibold text-base sm:text-lg">{{ $item->product->name }}</h2>
                <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                <p class="font-semibold text-sm">
                    Rental Period: <span class="font-normal">{{ $rental_days }} Days</span>
                </p>

                <!-- @if(isset($item->start_date, $item->end_date))
    <p class="text-sm text-gray-500">
        <i class="fas fa-calendar-alt mr-1"></i>
        {{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}
        - 
        {{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}
    </p>
@endif -->

            </div>
        </div>

        <p class="text-[#4B3B6B] text-sm leading-relaxed">
            {{ Str::limit($item->product->description, 100) }}
        </p>

        <div class="border-t border-gray-300 pt-4">
            <h3 class="font-semibold text-[#5B4B7A] mb-2">Delivery Information</h3>

            @if($item->delivery_option === 'pickup')
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
                        <p><strong>Recipient:</strong> {{ $item->recipient_name }}</p>
                        <p><strong>Phone:</strong> {{ $item->phone_number }}</p>
                        <p><strong>Address:</strong> {{ $item->delivery_address }}</p>
                    </div>
                </div>
            @endif
        </div>
    </article>
@endforeach

{{-- HANYA SEKALI - tampilkan total biaya --}}
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
    @php
    $shippingCost = $paymentData['pricing']['shipping_cost'] ?? $paymentData['pricing']['delivery_fee'] ?? 0;
@endphp

@if($shippingCost > 0)
    <div class="flex justify-between">
        <span>Shipping Costs</span>
        <span class="font-semibold">Rp. {{ number_format($shippingCost, 0, ',', '.') }}</span>
    </div>
@endif

</div>

<div class="border-t border-gray-300 pt-4 flex justify-between font-extrabold text-[#5B4B7A] text-lg">
    <span>Total</span>
    <span>Rp. {{ number_format($paymentData['pricing']['total'], 0, ',', '.') }}</span>
</div>
