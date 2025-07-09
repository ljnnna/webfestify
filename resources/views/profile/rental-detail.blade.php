@extends('layouts.app')

@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Home</a>
    <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Catalog</a>
    <a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Team</a>
    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Contact</a>
    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Profile</a>
</div>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-indigo-800 mb-2">Rental Transaction Details</h1>
        <div class="countdown-timer text-gray-600">
            <span id="countdown-text">Time remaining: </span>
            <strong id="countdown" class="text-indigo-600">02d 15h 30m 45s</strong>
        </div>
    </div>

    <!-- Main Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 py-4 text-white flex justify-between items-center">
                    <h2 class="text-lg font-semibold">Product Information</h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white bg-opacity-20">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>

                <div class="p-6">
                    @php
                        $rentalDays = \Carbon\Carbon::parse($order->start_date)->diffInDays(\Carbon\Carbon::parse($order->end_date));
                        if ($rentalDays <= 0) $rentalDays = 1;
                    @endphp

                    <!-- Product Items -->
                    <div class="flex flex-col gap-4">
                        @foreach ($order->orderProducts as $orderProduct)
                            @php
                                $product = $orderProduct->product;
                                $firstImage = $product->images->first()->path ?? null;
                            @endphp

                            <div class="border rounded-lg shadow-sm p-4 bg-white relative">
                                <div class="flex gap-4">
                                    <div class="w-20 h-20 rounded border overflow-hidden flex-shrink-0">
                                        <img src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('images/placeholder.jpg') }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    </div>

                                    <div class="flex-1 text-sm">
                                        <h3 class="font-semibold text-gray-900">{{ $product->name }}</h3>
                                        <p class="text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }} / day</p>
                                        <p class="text-gray-500 mt-1">Qty: {{ $orderProduct->quantity }} • {{ $rentalDays }} day(s)</p>

                                        @if ($product->details)
                                            <div class="mt-2 text-xs text-gray-600">
                                                <strong>Include:</strong>
                                                <ul class="list-disc list-inside">
                                                    @foreach(explode(',', $product->details) as $item)
                                                        <li>{{ trim($item) }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        @if ($order->status === 'active')
                                            <div class="mt-4">
                                                <a href="{{ route('return.initiate', ['order' => $order->id, 'orderProduct' => $orderProduct->id]) }}"
                                                    class="bg-indigo-600 text-white px-4 py-2 rounded shadow text-sm">
                                                    Return Equipment
                                                </a>
                                            </div>
                                        @endif
                                        @foreach ($order->orderProducts as $orderProduct)
    @if ($order->status !== 'active')
        <div class="mt-4">
            <a href="{{ route('return.history', ['order' => $order->id, 'orderProduct' => $orderProduct->id]) }}"
                class="bg-gray-700 text-white px-4 py-2 rounded shadow text-sm">
                View History - {{ $orderProduct->product->name ?? 'Product' }}
            </a>
        </div>
    @endif
@endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Condition Report -->
                    @php
                        $beforePhotos = [];
                        if (isset($return) && $return->condition_before) {
                            $beforePhotos = is_string($return->condition_before)
                                ? json_decode($return->condition_before, true)
                                : $return->condition_before;
                        }
                    @endphp

                    @if (!empty($beforePhotos))
                        <div class="mb-6">
                            <h3 class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">
                                <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Condition Report
                            </h3>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                                @foreach ($beforePhotos as $photo)
                                    <div class="relative group">
                                        <img src="{{ asset('storage/conditions/' . $photo) }}"
                                            class="w-full h-24 rounded-lg object-cover border border-gray-200 transition-transform duration-300 group-hover:scale-105" />
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center opacity-0 group-hover:opacity-100">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                                            </svg>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Payment Summary -->
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 sticky top-6">
                <div class="bg-indigo-600 px-6 py-4 text-white flex justify-between items-center">
                    <h2 class="text-base font-semibold">Payment Summary</h2>
                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-white bg-opacity-20">Paid</span>
                </div>

                @php
                    $rentalDays = \Carbon\Carbon::parse($order->start_date)->diffInDays(\Carbon\Carbon::parse($order->end_date));
                    if ($rentalDays <= 0) $rentalDays = 1;
                    $grandSubtotal = 0;
                @endphp

                <div class="p-6">
                    @foreach ($order->products as $product)
                        @php
                            $dailyRate = $product->pivot->unit_price;
                            $quantity = $product->pivot->quantity;
                            $subtotal = $product->pivot->subtotal;
                            $grandSubtotal += $subtotal;
                        @endphp

                        <div class="mb-2 mt-4">
                            <h4 class="text-sm font-semibold text-indigo-700">{{ $product->name }}</h4>
                        </div>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Daily Rate</span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($dailyRate, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Quantity</span>
                                <span class="font-medium text-gray-800">{{ $quantity }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Rental Days</span>
                                <span class="font-medium text-gray-800">{{ $rentalDays }} days</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            @if (!$loop->last)
                                <hr class="my-4 border-gray-300">
                            @endif
                        </div>
                    @endforeach

                    <hr class="my-4 border-t-2 border-gray-300">

                    @php
                        $deposit = $grandSubtotal * 0.5;
                        $serviceFee = 5000;
                        $totalPaid = $grandSubtotal + $deposit + $serviceFee;
                    @endphp

                    <div class="flex justify-between text-sm font-semibold text-gray-700">
                        <span>Total Rental</span>
                        <span>Rp {{ number_format($grandSubtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm mt-2">
                        <span class="text-gray-600">Deposit (50%)</span>
                        <span class="text-gray-800">Rp {{ number_format($deposit, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-sm mt-2">
                        <span class="text-gray-600">Service Fee</span>
                        <span class="text-gray-800">Rp {{ number_format($serviceFee, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between mt-4 pt-4 border-t-2 border-indigo-800">
                        <span class="font-bold">Total Amount</span>
                        <span class="font-bold text-indigo-800 text-lg">Rp {{ number_format($totalPaid, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const rawEndDate = '{{ $endDate }}';
    const endDate = new Date(rawEndDate).getTime();

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endDate - now;

        const countdownText = document.getElementById('countdown-text');
        const countdownValue = document.getElementById('countdown');

        if (distance < 0) {
            countdownText.textContent = "Return overdue: ";
            countdownValue.textContent = "Please return immediately";
            countdownValue.classList.add('text-red-600');
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        countdownValue.textContent = `${days}d ${hours}h ${minutes}m ${seconds}s`;

        if (days === 0 && hours < 24) {
            countdownText.textContent = "Due soon: ";
            countdownValue.classList.add('text-yellow-600');
        }
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
});
</script>
@endsection
