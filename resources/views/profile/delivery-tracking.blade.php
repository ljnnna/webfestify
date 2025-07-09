@extends('layouts.app')

@section('title', 'Order Tracking')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-[#493862]">Your Order Tracking</h2>

    {{-- ORDER & TRACKING INFO --}}
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8 shadow-md">
        <div class="mb-4">
            <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
            <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery_option) }}</p>
            <p><strong>Status:</strong>
                <span class="text-yellow-600 font-semibold">
                    {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                </span>
            </p>
        </div>

        @if ($order->delivery_option === 'delivery')
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
                'preparing'     => 'We are preparing your items.',
                'ready_to_ship' => 'Items are ready to ship.',
                'in_delivery'   => 'Items are on the way.',
                'delivered'     => 'Package has arrived.',
            ];

            $statusMap = [
                'order_confirmed'  => 'confirmed',
                'preparing_items'  => 'preparing',
                'ready_to_ship'    => 'ready_to_ship',
                'in_delivery'      => 'in_delivery',
                'delivered'        => 'delivered',
            ];

            $normalizedStatus = $statusMap[$order->delivery_status] ?? 'confirmed';
            $statuses = array_keys($steps);
            $currentStepIndex = array_search($normalizedStatus, $statuses);
        @endphp

        <div class="flex items-center justify-between relative mt-8">
            <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200 z-0 rounded-full"></div>
            <div class="absolute top-5 left-0 z-10 h-1 bg-purple-500 rounded-full transition-all duration-500"
                 style="width: {{ (($currentStepIndex + 1) / count($steps)) * 100 }}%"></div>

            @foreach ($steps as $key => $label)
                @php
                    $stepIndex = array_search($key, $statuses);
                    $completed = $stepIndex < $currentStepIndex;
                    $active = $stepIndex === $currentStepIndex;
                @endphp
                <div class="flex flex-col items-center z-20 w-1/5">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2
                        {{ $completed ? 'bg-purple-500 text-white' : ($active ? 'bg-purple-200 text-purple-700' : 'bg-gray-300 text-gray-600') }}">
                        {{ $stepIndex + 1 }}
                    </div>
                    <p class="text-sm font-semibold text-center {{ $active ? 'text-purple-700' : 'text-gray-600' }}">{{ $label }}</p>
                    <p class="text-xs text-gray-500 text-center">{{ $descriptions[$key] }}</p>
                </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- PICKUP INFO --}}
@if ($order->delivery_option === 'pickup')
<div class="bg-blue-50 p-6 rounded-lg mb-8 border border-blue-200">
    <h3 class="text-lg font-semibold text-blue-800 mb-3">Pickup Information</h3>
    <p class="text-sm text-gray-700 mb-1"><strong>Pickup Location:</strong> Politeknik Negeri Batam</p>
    <p class="text-sm text-gray-700 mb-1"><strong>Address:</strong> Jl. Ahmad Yani, Batam Center, Kota Batam</p>
    <p class="text-sm text-gray-700 mb-1"><strong>Pickup Date:</strong> {{ $order->start_date->format('d M Y') }} (1 day only)</p>
    <p class="text-sm text-gray-700 mb-1"><strong>Store Hours:</strong> 10:00 – 17:00 WIB</p>
    <p class="text-sm text-gray-700"><strong>Note:</strong> Bring your order code and a valid ID card.</p>

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

    @php
        $confirmedAt = null;
        $pickupDeadline = null;

        if ($order->pickup_confirmed_at) {
            $confirmedAt = \Carbon\Carbon::parse($order->pickup_confirmed_at);
            $storeOpen = $confirmedAt->copy()->setTime(10, 0);
            $storeClose = $confirmedAt->copy()->setTime(17, 0);

            if ($confirmedAt->between($storeOpen, $storeClose)) {
                $pickupDeadline = $confirmedAt->copy()->addHours(5);
                if ($pickupDeadline->gt($storeClose)) {
                    $pickupDeadline = $storeClose;
                }
            } else {
                $pickupDeadline = $confirmedAt->copy()->addDay()->setTime(10, 0)->addHours(5);
            }
        }
    @endphp

    @if (!$order->pickup_confirmed_at)
        <form action="{{ route('order.confirmPickup', $order->id) }}" method="POST" class="mt-6">
            @csrf
            <button type="submit"
                onclick="return confirm('Setelah dikonfirmasi, Anda memiliki waktu 5 jam untuk melakukan penjemputan.')"
                class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                Konfirmasi Penjemputan
            </button>
        </form>
    @else
        <div class="mt-6 text-sm text-green-700">
            Penjemputan telah dikonfirmasi pada <strong>{{ $confirmedAt->format('d M Y H:i') }}</strong>.<br>
            Harap ambil barang sebelum <strong>{{ $pickupDeadline->format('d M Y H:i') }}</strong>.<br>
            Sisa waktu: <span id="countdown" class="font-semibold text-red-600"></span>
        </div>

        @if ($pickupDeadline)
        <script>
            const deadline = new Date("{{ $pickupDeadline->format('Y-m-d H:i:s') }}").getTime();
            const countdown = document.getElementById('countdown');

            const interval = setInterval(() => {
                const now = new Date().getTime();
                const distance = deadline - now;

                if (distance < 0) {
                    clearInterval(interval);
                    countdown.innerText = 'Waktu habis';
                } else {
                    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdown.innerText = `${hours}j ${minutes}m ${seconds}d`;
                }
            }, 1000);
        </script>
        @endif
    @endif
</div>
@endif


    {{-- PRODUCT LIST --}}
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
                            <strong>Rental Period:</strong> {{ $order->start_date->format('d M Y') }} to {{ $order->end_date->format('d M Y') }}
                        </p>
                        <p class="text-sm text-gray-600">
                            <strong>Quantity:</strong> {{ $product->pivot->quantity ?? 1 }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- DELIVERY INFO --}}
    @if($order->delivery_option === 'delivery' && $order->delivery_address)
    <div class="bg-gray-100 p-4 rounded-lg mt-8 text-sm text-gray-700">
        <h4 class="font-bold mb-2">Delivery Information</h4>
        <p><strong>Recipient:</strong> {{ $order->name }}</p>
        <p><strong>Phone:</strong> {{ $order->phone }}</p>
        <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
    </div>
    @endif

    {{-- BACK BUTTON --}}
    <div class="mt-8">
        <a href="{{ route('profile.rentalInfo') }}" class="text-indigo-600 hover:underline">
            ← Back to My Orders
        </a>
    </div>
</div>
@endsection

