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
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- QR Code Section -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-qrcode text-purple-600 mr-2"></i>
                        Return QR Code
                    </h2>
                    <p class="text-gray-600 mb-6">Show this QR code to our staff when dropping off your item for quick processing.</p>
                    
                    <div class="flex justify-center mb-6">
                        <div class="bg-white p-4 rounded-lg border-2 border-gray-200 shadow-sm">
                            <!-- QR Code placeholder - you would generate actual QR code here -->
                            <div class="w-48 h-48 bg-gray-100 flex items-center justify-center rounded-lg">
                                <div class="text-center">
                                    <i class="fas fa-qrcode text-6xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-500">QR Code</p>
                                    <p class="text-xs text-gray-400">#{{ $order->order_code ?? $order->id }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-blue-50 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-900 mb-2">How to use QR Code:</h4>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Screenshot or save this QR code to your phone</li>
                            <li>• Show it to our staff at any dropoff location</li>
                            <li>• Staff will scan and process your return immediately</li>
                            <li>• You'll receive a confirmation receipt</li>
                        </ul>
                    </div>
                </div>

                <!-- Dropoff Locations -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>
                        Dropoff Locations
                    </h2>
                    <p class="text-gray-600 mb-6">Choose the most convenient location to return your item.</p>
                    
                    <div class="space-y-4">
                        <!-- Location 1 -->
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900 mb-2">Main Store - Batam Center</h3>
                                    <div class="space-y-2 text-sm text-gray-600">
                                        <div class="flex items-center">
                                            <i class="fas fa-map-marker-alt w-4 mr-2 text-red-500"></i>
                                            <span>Jl. Raja Ali Haji No. 123, Batam Center, Batam</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-clock w-4 mr-2 text-blue-500"></i>
                                            <span>Mon-Sun: 09:00 - 21:00</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-phone w-4 mr-2 text-green-500"></i>
                                            <span>+62 778-123456</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ml-4 flex flex-col space-y-2">
                                    <a href="https://maps.google.com/?q=Jl.+Raja+Ali+Haji+No.+123+Batam+Center" 
                                       target="_blank"
                                       class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600 transition-colors">
                                        <i class="fas fa-directions mr-1"></i>
                                        Directions
                                    </a>
                                    <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-medium text-center">
                                        2.5 km
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dropoff Instructions -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-list-check text-green-600 mr-2"></i>
                        Dropoff Instructions
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">Before You Go:</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Clean the item and remove personal belongings</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Take photos of item condition (optional but recommended)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Bring this QR code (screenshot or printed)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-check-circle text-green-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Bring valid ID for verification</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-3">At The Location:</h3>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-blue-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Show QR code to staff or scan at express point</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-blue-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Present the item for quick inspection</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-blue-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Receive confirmation receipt</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-arrow-right text-blue-500 mt-0.5 mr-2 flex-shrink-0"></i>
                                    <span>Return process completed!</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">

                <!-- Penalty Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                        Penalty Information
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Due Date</span>
                            <span class="text-sm font-medium">{{ $order->end_date->format('d M Y, H:i') }}</span>
                        </div>
                        
                        {{-- Show penalties if any --}}
                        @if($order->penalties && $order->penalties->count() > 0)
                            <div class="bg-red-50 rounded-lg p-4">
                                <h4 class="text-sm font-semibold text-red-800 mb-3">Applied Penalties:</h4>
                                <div class="space-y-2">
                                    @php $totalPenalty = 0; @endphp
                                    @foreach($order->penalties as $penalty)
                                        <div class="flex justify-between items-center text-sm">
                                            <span class="text-red-700">{{ $penalty->description }}</span>
                                            <span class="font-semibold text-red-600">
                                                Rp {{ number_format($penalty->amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        @php $totalPenalty += $penalty->amount; @endphp
                                    @endforeach
                                    
                                    @if($order->penalties->count() > 1)
                                        <div class="border-t border-red-200 pt-2 mt-2">
                                            <div class="flex justify-between items-center text-sm font-bold">
                                                <span class="text-red-800">Total Penalty</span>
                                                <span class="text-red-600">
                                                    Rp {{ number_format($totalPenalty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                
                                @if($penalty->notes ?? false)
                                    <div class="mt-3 p-2 bg-red-100 rounded text-xs text-red-700">
                                        <strong>Notes:</strong> {{ $penalty->notes }}
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="text-center">
                                    <i class="fas fa-check-circle text-green-500 text-lg mb-2"></i>
                                    <p class="text-sm text-green-700 font-medium">No Penalty</p>
                                    <p class="text-xs text-green-600">Return as scheduled</p>
                                </div>
                            </div>
                        @endif
                        
                        <div class="text-xs text-gray-500 bg-gray-50 rounded p-3">
                            <p class="font-medium mb-2">Possible Penalty Types:</p>
                            <ul class="space-y-1">
                                <li>• Late return fee</li>
                                <li>• Item damage fee</li>
                                <li>• Lost item replacement</li>
                                <li>• Condition mismatch fee</li>
                                <li>• Additional administrative costs</li>
                            </ul>
                            <p class="text-xs text-gray-400 mt-2 italic">
                                *Penalties will be determined by staff after item evaluation
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Add Review -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                        Add Review
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Share your experience with this rental</p>
                    
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        
                        <!-- Rating -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                            <div class="flex space-x-1" id="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="rating-star text-2xl text-gray-300 hover:text-yellow-400 focus:outline-none" data-rating="{{ $i }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input" required>
                        </div>
                        
                        <!-- Comment -->
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                            <textarea name="comment" id="comment" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none"
                                      placeholder="Tell us about your experience..."></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-purple-600 text-white py-2 px-4 rounded-lg hover:bg-purple-700 transition-colors">
                            Submit Review
                        </button>
                    </form>
                </div>


                <!-- Contact Support -->
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-2xl shadow-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Need Help?</h3>
                    <p class="text-sm mb-4 opacity-90">Contact our support team for assistance with your return.</p>
                    <div class="space-y-2">
                        <a href="tel:+6281234567890" class="flex items-center text-sm hover:underline">
                            <i class="fas fa-phone mr-2"></i>
                            +62 812-3456-7890
                        </a>
                        <a href="mailto:support@rental.com" class="flex items-center text-sm hover:underline">
                            <i class="fas fa-envelope mr-2"></i>
                            support@rental.com
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-refresh QR code every 30 seconds to ensure it's valid
    setInterval(function() {
        // You can implement QR code refresh logic here if needed
        console.log('QR Code refreshed');
    }, 30000);

    // Add click handlers for location cards
    document.querySelectorAll('.border.border-gray-200.rounded-lg').forEach(function(card) {
        card.addEventListener('click', function(e) {
            // Don't trigger if clicking on directions button
            if (!e.target.closest('a')) {
                // You can add logic here to show more details or select location
                console.log('Location selected');
            }
        });
    });
});
</script>
@endsection