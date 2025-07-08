@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Order Tracking</h2>

    <!-- Order Info -->
    <div class="mb-6 text-sm text-gray-700">
        <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
        <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery_option) }}</p>
        <p><strong>Status:</strong>
            @switch($trackingStatus)
                @case('preparing')
                    <span class="text-blue-600 font-medium">Preparing</span>
                    @break
                @case('ready_to_ship')
                    <span class="text-indigo-600 font-medium">Ready to Ship</span>
                    @break
                @case('in_delivery')
                    <span class="text-yellow-600 font-medium">On the Way</span>
                    @break
                @case('delivered')
                    <span class="text-green-600 font-medium">Delivered</span>
                    @break
                @case('ready_pickup')
                    <span class="text-blue-600 font-medium">Ready for Pickup</span>
                    @break
                @default
                    <span class="text-gray-600">Confirmed</span>
            @endswitch
        </p>
    </div>

    <!-- Conditional Section -->
    @if($order->delivery_option === 'delivery')
        @php
            $steps = [
                'confirmed'     => 'Order Confirmed',
                'preparing'     => 'Preparing Items',
                'ready_to_ship' => 'Ready to Ship',
                'in_delivery'   => 'In Delivery',
                'delivered'     => 'Delivered',
            ];

            $descriptions = [
                'confirmed'     => 'Your order has been received.',
                'preparing'     => 'Admin is preparing your items.',
                'ready_to_ship' => 'Items are ready to be shipped.',
                'in_delivery'   => 'Items are on the way.',
                'delivered'     => 'Delivery completed.',
            ];

            $stepKeys = array_keys($steps);
            $currentIndex = array_search($trackingStatus, $stepKeys) !== false ? array_search($trackingStatus, $stepKeys) : 0;
        @endphp

        <div class="w-full max-w-4xl mx-auto mb-12">
            <div class="relative flex justify-between items-center">
                <div class="absolute top-5 left-0 w-full h-1 bg-gray-200 z-0">
                    <div class="h-1 bg-gradient-to-r from-purple-500 to-purple-700 z-10 transition-all duration-500"
                        style="width: {{ ($currentIndex / (count($steps) - 1)) * 100 }}%;">
                    </div>
                </div>

                @foreach ($steps as $key => $label)
                    @php
                        $index = array_search($key, $stepKeys);
                        $isActive = $index <= $currentIndex;
                    @endphp
                    <div class="flex flex-col items-center text-center w-1/5 relative z-20">
                        <div class="w-10 h-10 flex items-center justify-center rounded-full text-sm font-bold 
                            {{ $isActive ? 'bg-purple-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                            {{ $index + 1 }}
                        </div>
                        <div class="mt-2 text-sm font-semibold 
                            {{ $isActive ? 'text-purple-700' : 'text-gray-500' }}">
                            {{ $label }}
                        </div>
                        <div class="text-xs text-gray-500 mt-1 text-center px-2 leading-snug">
                            {{ $descriptions[$key] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <!-- Pickup Info -->
        <div class="bg-blue-50 p-6 rounded-lg mb-8 border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Pickup Information</h3>
            <p class="text-sm text-gray-700 mb-1"><strong>Pickup Location:</strong> Politeknik Negeri Batam</p>
            <p class="text-sm text-gray-700 mb-1"><strong>Address:</strong> Jl. Ahmad Yani, Batam Center, Kota Batam, Kepulauan Riau 29461</p>
            <p class="text-sm text-gray-700 mb-1"><strong>Pickup Date:</strong> {{ $order->start_date->format('d M Y') }} (1 day only)</p>
            <p class="text-sm text-gray-700 mb-1"><strong>Store Hours:</strong> 10:00 – 17:00 WIB</p>
            <p class="text-sm text-gray-700"><strong>Note:</strong> Please bring your order code and a valid ID card to show to our staff.</p>

            <!-- Google Maps -->
            <div class="mt-4">
                <iframe
                    class="w-full rounded-lg border border-gray-300"
                    height="300"
                    style="border:0"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.110226507371!2d104.0504628147535!3d1.096679899161678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d988dbaf4a3575%3A0x4362e5c5b8125129!2sPoliteknik%20Negeri%20Batam!5e0!3m2!1sen!2sid!4v1655562081257!5m2!1sen!2sid">
                </iframe>
            </div>
        </div>
    @endif

<!-- Product Card -->
<!-- Product Card -->
<div class="mt-10">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Product Details</h3>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($order->products as $product)
                <div class="border rounded-lg p-4 bg-white shadow-sm hover:bg-gray-50 cursor-pointer">
                    <div class="flex gap-4">
                    @if ($product->images->isNotEmpty())
    <img src="{{ asset('storage/' . $product->images->first()->path) }}"
         alt="{{ $product->name }}"
         class="w-24 h-24 object-cover rounded-md border" />
@else
    <div class="w-24 h-24 flex items-center justify-center bg-gray-200 text-xs text-gray-600 rounded-md border">
        No Image
    </div>
@endif
                        <div class="flex-1">
                            <div class="flex justify-between items-start mb-2">
                                <h4 class="text-lg font-medium text-gray-900">{{ $product->name }}</h4>
                                <span class="text-sm text-gray-500">{{ $product->category->name ?? '-' }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">
                                <strong>Rental Period:</strong>
                                {{ $order->start_date->format('d M Y') }} to {{ $order->end_date->format('d M Y') }}
                            </p>
                            <p class="text-sm text-gray-600">
                                <strong>Quantity:</strong> {{ $product->pivot->quantity ?? 1 }}
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>



<!-- Delivery Address (for delivery only) -->
@if($order->delivery_option === 'delivery' && $order->delivery_address)
    <div class="bg-gray-100 p-4 rounded-lg mt-8 text-sm text-gray-700">
        <h4 class="font-bold mb-2">Delivery Information</h4>
        <p><strong>Recipient:</strong> {{ $order->name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
    </div>
@endif

    <!-- Back -->
    <div class="mt-8">
        <a href="{{ route('profile.rentalInfo') }}" class="text-indigo-600 hover:underline">
            ← Back to My Orders
        </a>
    </div>
</div>
@endsection
