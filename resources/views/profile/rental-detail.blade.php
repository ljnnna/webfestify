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
    <!-- Header Section -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-indigo-800 mb-2">Rental Transaction Details</h1>
        <div class="countdown-timer text-gray-600">
            <span id="countdown-text">Time remaining: </span>
            <strong id="countdown" class="text-indigo-600">02d 15h 30m 45s</strong>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column (Product Info) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200">
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 px-6 py-4 text-white flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-semibold">Product Information</h2>
                    </div>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white bg-opacity-20">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>
                
                <div class="p-6">
                    <!-- Product Information -->
                    @foreach ($order->products as $product)
                    <div class="flex flex-col sm:flex-row gap-6 mb-6 pb-6 border-b border-gray-200">
                        <div class="w-full sm:w-40 h-32 rounded-lg overflow-hidden border border-gray-200 flex-shrink-0">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.jpg') }}" 
                                 alt="{{ $product->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                            <span class="inline-block mt-1 text-sm bg-gray-100 text-gray-700 px-2 py-1 rounded">
                                Rp. {{ number_format($product->price, 0, ',', '.') }} /day
                            </span>
                        </div>
                    </div>
                    @endforeach

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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                                    </svg>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Product Details -->
                    <div>
                        <h3 class="flex items-center text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">
                            <svg class="w-4 h-4 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Product Details
                        </h3>
                        <div class="grid grid-cols-[max-content,1fr] gap-x-4 gap-y-2 text-sm text-gray-700">
                            <div class="font-medium text-gray-600">Include:</div>
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $product->details) as $item)
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">
                                    {{ trim($item) }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column (Payment Summary) -->
        <div class="space-y-6">
            <!-- Summary Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 sticky top-6">
                <div class="bg-indigo-600 px-6 py-4 text-white">
                    <div class="flex justify-between items-center">
                        <h2 class="text-base font-semibold">Payment Summary</h2>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-white bg-opacity-20">
                            Paid
                        </span>
                    </div>
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
                        
                        <div class="space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Daily Rate</span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($dailyRate, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Quantity</span>
                                <span class="font-medium text-gray-800">{{ $quantity }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Rental Days</span>
                                <span class="font-medium text-gray-800">{{ $rentalDays }} days</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-800">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        
                        @if (!$loop->last)
                            <hr class="my-4 border-gray-200">
                        @endif
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
            <!-- Support Information -->


        </div>
    </div>

    <!-- Return Process Section -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 mt-8">
        <div class="p-6 text-center">
            <h3 class="flex items-center justify-center text-xl font-semibold text-indigo-800 mb-2">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Equipment Return Process
            </h3>
            <p class="text-sm text-gray-600 max-w-2xl mx-auto mb-6">
                Please select your preferred return method and confirm your return request. 
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="return-option bg-gray-50 rounded-lg p-4 border-2 border-indigo-600 cursor-pointer transition-colors duration-200 text-center">
                    <div class="text-indigo-600 text-2xl mb-2">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h4 class="text-sm font-semibold text-gray-800 mb-1">In-Person Drop Off</h4>
                    <p class="text-xs text-gray-600">Return equipment to our location during business hours</p>
                </div>
                <div class="return-option bg-gray-50 rounded-lg p-4 border border-gray-200 cursor-pointer transition-colors duration-200 hover:border-indigo-400 text-center">
                    <div class="text-gray-600 text-2xl mb-2">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <h4 class="text-sm font-semibold text-gray-800 mb-1">Scheduled Pickup</h4>
                    <p class="text-xs text-gray-600">We'll collect the equipment from your location</p>
                </div>
            </div>
            
            <form method="POST" action="{{ route('return.create', ['order' => $order->id]) }}" class="max-w-md mx-auto">
                @csrf
                <input type="hidden" name="return_option" id="returnOptionInput" value="dropoff">
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-3 px-6 rounded-lg font-semibold text-sm hover:shadow-md transition-all duration-200">
                    Initiate Return Process
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Countdown Timer
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

    // Return Method Selection
    const returnOptions = document.querySelectorAll('.return-option');
    const hiddenInput = document.getElementById('returnOptionInput');

    returnOptions.forEach(option => {
        option.addEventListener('click', function() {
            returnOptions.forEach(opt => {
                opt.classList.remove('border-2', 'border-indigo-600');
                opt.classList.add('border', 'border-gray-200');
                opt.querySelector('div').classList.remove('text-indigo-600');
                opt.querySelector('div').classList.add('text-gray-600');
            });
            
            this.classList.remove('border', 'border-gray-200');
            this.classList.add('border-2', 'border-indigo-600');
            this.querySelector('div').classList.remove('text-gray-600');
            this.querySelector('div').classList.add('text-indigo-600');
            
            const title = this.querySelector('h4').textContent.trim().toLowerCase();
            hiddenInput.value = title.includes('pickup') ? 'pickup' : 'dropoff';
        });
    });
});
</script>
@endsection