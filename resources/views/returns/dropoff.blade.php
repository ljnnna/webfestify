@extends('layouts.app')

@section('title', 'Return - Dropoff')

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
    <a href="{{ route('profile.edit') }}"
         class="{{ request()->routeIs('profile.*') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
         Profile
    </a>
</div>
@endsection

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-4">
    <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT PANEL --}}
        <div class="lg:col-span-2 space-y-8">
            @php
                $rentalItem = $return->orderProduct;
                $product = $rentalItem->product;
                $order = $rentalItem->order;
            @endphp

            {{-- QR CODE --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold mb-2 text-gray-900 flex items-center">
                    <i class="fas fa-qrcode text-purple-600 mr-2"></i> Return QR Code
                </h2>
                <p class="text-gray-600 mb-4">
                    Show this QR code when returning <strong>{{ $product->name }}</strong>.
                </p>
                <div class="flex justify-center mb-6">
                    <div class="w-48 h-48 flex items-center justify-center bg-gray-100 rounded-lg border-2 border-gray-200 shadow-inner">
                        <div class="text-center">
                            <i class="fas fa-qrcode text-6xl text-gray-400 mb-2"></i>
                            <p class="text-xs text-gray-500">
                                #{{ $order->order_code ?? $order->id }} - {{ $product->name }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg text-sm text-blue-800">
                    <p class="font-medium mb-2">How to return:</p>
                    <ul class="space-y-1 list-disc list-inside">
                        <li>Save this QR to your phone</li>
                        <li>Show it at drop-off point</li>
                        <li>Staff will scan and confirm return</li>
                    </ul>
                </div>
            </div>

            {{-- DROP-OFF LOCATION + INSTRUCTIONS --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-900 flex items-center">
                    <i class="fas fa-map-marker-alt text-red-600 mr-2"></i> Dropoff Info & Instructions
                </h2>

                {{-- Location Info --}}
                <div class="mb-6 border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">Main Store - Batam Center</h3>
                            <div class="mt-2 text-sm text-gray-600 space-y-1">
                                <div><i class="fas fa-map-marker-alt text-red-500 mr-1 w-4 inline-block"></i>Jl. Raja Ali Haji No.123</div>
                                <div><i class="fas fa-clock text-blue-500 mr-1 w-4 inline-block"></i>Mon-Sun: 09:00 - 21:00</div>
                                <div><i class="fas fa-phone text-green-500 mr-1 w-4 inline-block"></i>+62 778-123456</div>
                            </div>
                        </div>
                        <div class="flex flex-col items-start space-y-2">
                            <a href="https://maps.google.com/?q=Jl.+Raja+Ali+Haji+No.+123+Batam+Center" target="_blank"
                               class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                <i class="fas fa-directions mr-1"></i> Directions
                            </a>
                            <span class="text-green-700 text-xs bg-green-100 px-2 py-1 rounded font-medium">2.5 km</span>
                        </div>
                    </div>
                </div>

                {{-- Instructions --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-700">
                    <div>
                        <h4 class="font-semibold mb-2">Before You Go</h4>
                        <ul class="space-y-2">
                            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i> Clean item & remove personal items</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i> Take item photo (optional)</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i> Bring the QR code</li>
                            <li class="flex items-start"><i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i> Bring your ID</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">At The Location</h4>
                        <ul class="space-y-2">
                            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-2"></i> Show the QR code</li>
                            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-2"></i> Staff will inspect</li>
                            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-2"></i> Confirmation received</li>
                            <li class="flex items-start"><i class="fas fa-arrow-right text-blue-500 mt-1 mr-2"></i> Done!</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="space-y-6">
            {{-- Penalty Info --}}
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i> Penalty Information
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm border-b pb-2">
                        <span class="text-gray-600">Due Date</span>
                        <span class="font-medium">{{ $order->end_date->format('d M Y, H:i') }}</span>
                    </div>

                    @php
                        $penalties = $return->penalties ?? collect();
                        $hasPenalty = $penalties->count() > 0;
                        $total = 0;
                    @endphp

                    @if ($hasPenalty)
                        <div class="bg-red-50 p-4 rounded-lg text-sm text-red-700">
                            <p class="font-semibold mb-2">Applied Penalties:</p>
                            @foreach($penalties as $penalty)
                                <div class="flex justify-between">
                                    <span>{{ $penalty->description }}</span>
                                    <span>Rp {{ number_format($penalty->amount, 0, ',', '.') }}</span>
                                </div>
                                @php $total += $penalty->amount; @endphp
                            @endforeach
                            <div class="mt-3 border-t pt-2 flex justify-between font-semibold text-red-800">
                                <span>Total</span>
                                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    @else
                        <div class="bg-green-50 p-4 text-center text-green-700 text-sm rounded-lg">
                            <i class="fas fa-check-circle mb-2 text-green-500 text-lg"></i>
                            <p class="font-semibold">No Penalties Applied</p>
                            <p class="text-xs">Return completed on time</p>
                        </div>
                    @endif

                    <div class="text-xs text-gray-600 bg-gray-50 rounded p-4">
                        <p class="font-semibold mb-2">Possible Penalties:</p>
                        <ul class="space-y-1 list-disc list-inside">
                            <li>Late return fee (Rp50,000/day)</li>
                            <li>Damage or missing parts</li>
                            <li>Excessive cleaning</li>
                        </ul>
                        <p class="text-[10px] text-gray-400 mt-2 italic">
                            *Penalties are applied after inspection
                        </p>
                    </div>
                </div>
            </div>

            {{-- Review --}}
            <div class="bg-white p-6 rounded-xl shadow-md mt-6">
                @if (!$alreadyReviewed)
                    @include('components.add-review', ['return' => $return, 'alreadyReviewed' => $alreadyReviewed])
                @else
                    <div class="bg-green-50 p-4 rounded-lg shadow-sm text-green-700 text-sm">
                        <i class="fas fa-check-circle mr-2 text-green-500"></i>
                        You've already submitted a review for this product. Thank you!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    setInterval(() => {
        console.log('QR Code refreshed');
    }, 30000);

    document.querySelectorAll('.border.border-gray-200.rounded-lg').forEach(card => {
        card.addEventListener('click', function(e) {
            if (!e.target.closest('a')) {
                console.log('Location selected');
            }
        });
    });
});
</script>
@endsection
