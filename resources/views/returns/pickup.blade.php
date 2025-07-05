@extends('layouts.app')

@section('title', 'Return - Pickup')

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
<div class="min-h-screen bg-gray-50 p-4 sm:p-6">
    <div class="max-w-4xl mx-auto"> <!-- Reduced from max-w-6xl to max-w-4xl -->
        <!-- Enhanced Return Progress -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full mr-4 shadow-md">
                    <i class="fas fa-route text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Return Status</h3>
                    <p class="text-sm text-gray-500">Track your return process step by step</p>
                </div>
            </div>
            
            <div class="relative">
                <!-- Progress line with gradient -->
                <div class="absolute top-5 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-purple-600 z-0 rounded-full"></div>
                
                <div class="relative z-10 flex justify-between">
                    @php
                        $steps = [
                            ['status' => 'Photos Uploaded', 'completed' => false, 'current' => true, 'icon' => 'camera', 'description' => 'Upload item condition photos'],
                            ['status' => 'Review Submitted', 'completed' => false, 'current' => false, 'icon' => 'star', 'description' => 'Share your rental experience'],
                            ['status' => 'Item Collected', 'completed' => false, 'current' => false, 'icon' => 'truck', 'description' => 'Item picked up from location'],
                            ['status' => 'Quality Check', 'completed' => false, 'current' => false, 'icon' => 'search', 'description' => 'Inspecting item condition'],
                            ['status' => 'Return Completed', 'completed' => false, 'current' => false, 'icon' => 'check-circle', 'description' => 'Process finished successfully'],
                        ];
                    @endphp
                    
                    @foreach($steps as $index => $step)
                    <div class="flex flex-col items-center w-1/5">
                        <div class="mb-2 relative">
                            @if($step['completed'])
                                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-green-500 to-teal-400 flex items-center justify-center ring-4 ring-white shadow-lg transform hover:scale-110 transition-transform">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full whitespace-nowrap">
                                    Completed
                                </div>
                            @elseif($step['current'])
                                <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center ring-4 ring-white shadow-lg transform scale-110 transition-transform duration-300 animate-pulse">
                                    <i class="fas fa-{{ $step['icon'] }} text-white text-sm"></i>
                                </div>
                                <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full whitespace-nowrap">
                                    In Progress
                                </div>
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center ring-4 ring-white shadow-sm transform hover:scale-105 transition-transform">
                                    <i class="fas fa-{{ $step['icon'] }} text-gray-400 text-sm"></i>
                                </div>
                            @endif
                        </div>
                        <div class="text-center px-2 mt-6">
                            <p class="text-xs font-semibold {{ $step['current'] ? 'text-blue-600' : ($step['completed'] ? 'text-green-600' : 'text-gray-500') }} uppercase tracking-wider">
                                Step {{ $index + 1 }}
                            </p>
                            <p class="text-sm font-medium text-gray-800 mt-1">
                                {{ $step['status'] }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1 leading-tight">{{ $step['description'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Main Content (Left Column) -->
            <div class="lg:col-span-8 space-y-6">
                <!-- Photo Upload Section -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3">
                                <i class="fas fa-camera text-sm"></i>
                            </span>
                            <span>Item Condition Photos</span>
                        </h2>
                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">Required</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-6">Upload clear photos showing the item's current condition from multiple angles.</p>
                    
                    <form id="photoUploadForm" method="POST" action="{{ route('return.upload-photos', $order->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <!-- Photo Upload Area -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors cursor-pointer bg-gray-50"
                                 onclick="document.getElementById('photoInput').click()">
                                <input type="file" id="photoInput" name="condition_photos[]" multiple accept="image/*" class="hidden">
                                <div id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-blue-400 mb-3"></i>
                                    <p class="text-gray-600 text-sm mb-1">Click or drag photos to upload</p>
                                    <p class="text-xs text-gray-500">Max 5 photos (JPEG, PNG) • 5MB each</p>
                                </div>
                            </div>

                            <!-- Photo Preview -->
                            <div id="photoPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-3 hidden"></div>

                            <!-- Upload Button -->
                            <button type="submit" id="uploadBtn" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2.5 px-4 rounded-lg font-medium hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed shadow-md" disabled>
                                <i class="fas fa-upload mr-2"></i>
                                Upload Photos
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Photo Condition After (Admin Uploaded) -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg sm:text-xl font-semibold text-gray-900 flex items-center">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3">
                                <i class="fas fa-camera-retro text-sm"></i>
                            </span>
                            <span>Item Condition After Return</span>
                        </h2>
                        <span class="text-xs bg-gray-100 text-gray-800 px-2 py-1 rounded-full">Admin Uploaded</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Photos taken by our team after receiving the item.</p>

                    @if($order->return_photos && count($order->return_photos) > 0)
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($order->return_photos as $photo)
                            <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ asset('storage/' . $photo) }}" 
                                     class="w-full h-28 object-cover"
                                     alt="Return condition photo {{ $loop->iteration }}">
                                <a href="{{ asset('storage/' . $photo) }}" 
                                   target="_blank"
                                   class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                                    <span class="bg-white text-blue-600 px-3 py-1 rounded-full text-xs font-medium shadow-sm">
                                        <i class="fas fa-expand mr-1"></i> View Full
                                    </span>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 rounded-md">
                            <p class="text-sm">No return photos available yet. Please check back after verification is complete.</p>
                        </div>
                    @endif

                    @if($order->return_notes)
                        <div class="mt-4 bg-gray-50 rounded-lg p-4 border border-gray-100">
                            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-clipboard-list text-blue-500 mr-2"></i>
                                Admin Notes:
                            </h4>
                            <p class="text-sm text-gray-600">{{ $order->return_notes }}</p>
                        </div>
                    @endif
                </div>

                <!-- Pickup Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h2 class="text-lg sm:text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <span class="bg-blue-100 text-blue-600 p-2 rounded-full mr-3">
                            <i class="fas fa-truck text-sm"></i>
                        </span>
                        <span>Pickup Information</span>
                    </h2>
                    
                    <div class="bg-blue-50 rounded-lg p-4 mb-4 border border-blue-100">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 pt-0.5">
                                <i class="fas fa-info-circle text-blue-500"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Pickup Instructions</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <ul class="space-y-1.5">
                                        <li class="flex items-start">
                                            <i class="fas fa-phone-alt text-xs mt-1 mr-2 text-blue-500"></i>
                                            <span>Our courier will call you 30 minutes before arrival</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-box-open text-xs mt-1 mr-2 text-blue-500"></i>
                                            <span>Please have the item ready and packed securely</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i class="fas fa-user-check text-xs mt-1 mr-2 text-blue-500"></i>
                                            <span>Ensure someone is available at the pickup address</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <h3 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-map-marker-alt text-blue-500 mr-2 text-sm"></i>
                                Pickup Address
                            </h3>
                            <p class="text-gray-900 text-sm">{{ $order->delivery_address ?? auth()->user()->address ?? 'Address not set' }}</p>
                            <a href="https://maps.google.com/?q={{ urlencode($order->delivery_address ?? auth()->user()->address ?? '') }}" 
                               target="_blank"
                               class="inline-flex items-center mt-2 text-xs text-blue-600 hover:text-blue-800">
                                <i class="fas fa-external-link-alt mr-1 text-xs"></i>
                                View on Map
                            </a>
                        </div>
                        
                        <div class="bg-white border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <h3 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-user-circle text-blue-500 mr-2 text-sm"></i>
                                Contact Information
                            </h3>
                            <p class="text-gray-900 text-sm">{{ auth()->user()->name }}</p>
                            <p class="text-gray-900 text-sm">{{ auth()->user()->phone ?? 'Phone not set' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Right Column) -->
            <div class="lg:col-span-4 space-y-6">
                <!-- Add Review -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="bg-yellow-100 text-yellow-600 p-2 rounded-full mr-3">
                            <i class="fas fa-star text-sm"></i>
                        </span>
                        <span>Add Review</span>
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">Share your experience with this rental</p>
                    
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                        
                        <!-- Rating -->
                        <div class="mb-4">
                            <div class="flex justify-center space-x-1" id="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" class="rating-star text-2xl text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors" data-rating="{{ $i }}">
                                        <i class="fas fa-star"></i>
                                    </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-input" required>
                        </div>
                        
                        <!-- Comment -->
                        <div class="mb-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
                            <textarea name="comment" id="comment" rows="3" 
                                      class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                                      placeholder="Tell us about your experience..."></textarea>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-2 px-4 rounded-lg font-medium hover:opacity-90 transition-opacity shadow-md">
                            Submit Review
                        </button>
                    </form>
                </div>

                <!-- Penalty Information -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                        <span class="bg-red-100 text-red-600 p-2 rounded-full mr-3">
                            <i class="fas fa-exclamation-triangle text-sm"></i>
                        </span>
                        <span>Penalty Information</span>
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100">
                            <span class="text-sm text-gray-600">Due Date</span>
                            <span class="text-sm font-medium">{{ $order->end_date->format('d M Y, H:i') }}</span>
                        </div>
                        
                        @if($order->penalties && $order->penalties->count() > 0)
                            <div class="bg-red-50 rounded-lg p-3 border border-red-100">
                                <h4 class="text-sm font-semibold text-red-800 mb-2 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i>
                                    Applied Penalties:
                                </h4>
                                <div class="space-y-2">
                                    @php $totalPenalty = 0; @endphp
                                    @foreach($order->penalties as $penalty)
                                        <div class="flex justify-between items-center text-xs">
                                            <span class="text-red-700">{{ $penalty->description }}</span>
                                            <span class="font-semibold text-red-600">
                                                Rp {{ number_format($penalty->amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                        @php $totalPenalty += $penalty->amount; @endphp
                                    @endforeach
                                    
                                    @if($order->penalties->count() > 1)
                                        <div class="border-t border-red-200 pt-2 mt-2">
                                            <div class="flex justify-between items-center text-xs font-bold">
                                                <span class="text-red-800">Total Penalty</span>
                                                <span class="text-red-600">
                                                    Rp {{ number_format($totalPenalty, 0, ',', '.') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="bg-green-50 rounded-lg p-4 text-center border border-green-100">
                                <i class="fas fa-check-circle text-green-500 text-xl mb-2"></i>
                                <p class="text-sm text-green-700 font-medium">No Penalties Applied</p>
                                <p class="text-xs text-green-600 mt-1">Return as scheduled</p>
                            </div>
                        @endif
                        
                        <div class="text-xs text-gray-500 bg-gray-50 rounded p-3 border border-gray-100">
                            <p class="font-medium mb-1 text-gray-600">Possible Penalties:</p>
                            <ul class="space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-clock text-xs mt-0.5 mr-1.5 text-gray-400"></i>
                                    <span>Late return fee (Rp50,000/day)</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-times-circle text-xs mt-0.5 mr-1.5 text-gray-400"></i>
                                    <span>Item damage or missing parts</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-broom text-xs mt-0.5 mr-1.5 text-gray-400"></i>
                                    <span>Excessive cleaning required</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact Support -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-md p-6 text-white border border-blue-500">
                    <h3 class="text-lg font-semibold mb-2 flex items-center">
                        <i class="fas fa-headset mr-2"></i>
                        Need Help?
                    </h3>
                    <p class="text-sm mb-4 opacity-90">Our support team is available to assist you.</p>
                    <div class="space-y-3">
                        <a href="mailto:support@rental.com" class="flex items-center text-sm hover:underline hover:opacity-90">
                            <i class="fas fa-envelope mr-2"></i>
                            support@rental.com
                        </a>
                        <a href="https://wa.me/6281234567890" class="flex items-center text-sm hover:underline hover:opacity-90">
                            <i class="fab fa-whatsapp mr-2"></i>
                            Chat on WhatsApp
                        </a>
                        <a href="tel:+6281234567890" class="flex items-center text-sm hover:underline hover:opacity-90">
                            <i class="fas fa-phone-alt mr-2"></i>
                            +62 812 3456 7890
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Photo upload functionality
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const uploadBtn = document.getElementById('uploadBtn');
    let selectedFiles = [];

    photoInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        
        if (files.length > 5) {
            alert('Maximum 5 photos allowed');
            return;
        }

        selectedFiles = files;
        displayPhotoPreview(files);
        uploadBtn.disabled = files.length === 0;
    });

    function displayPhotoPreview(files) {
        photoPreview.innerHTML = '';
        
        if (files.length > 0) {
            photoPreview.classList.remove('hidden');
            
            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative group rounded-lg overflow-hidden border border-gray-200';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-28 object-cover">
                        <button type="button" onclick="removePhoto(${index})" 
                                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 transition-colors shadow-md">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 truncate">
                            ${file.name.substring(0, 20)}${file.name.length > 20 ? '...' : ''}
                        </div>
                    `;
                    photoPreview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        } else {
            photoPreview.classList.add('hidden');
        }
    }

    window.removePhoto = function(index) {
        selectedFiles.splice(index, 1);
        
        // Update file input
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        photoInput.files = dt.files;
        
        displayPhotoPreview(selectedFiles);
        uploadBtn.disabled = selectedFiles.length === 0;
    };

    // Form submission
    document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
        if (selectedFiles.length === 0) {
            e.preventDefault();
            alert('Please upload at least one photo before proceeding.');
            return;
        }
        
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Uploading...';
        uploadBtn.disabled = true;
    });

    // Rating stars functionality
    const stars = document.querySelectorAll('.rating-star');
    const ratingInput = document.getElementById('rating-input');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            
            // Update star colors
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.remove('text-gray-300');
                    s.classList.add('text-yellow-400');
                } else {
                    s.classList.remove('text-yellow-400');
                    s.classList.add('text-gray-300');
                }
            });
        });
        
        // Hover effects
        star.addEventListener('mouseover', function() {
            const rating = this.getAttribute('data-rating');
            stars.forEach((s, i) => {
                if (i < rating) {
                    s.classList.add('text-yellow-300');
                }
            });
        });
        
        star.addEventListener('mouseout', function() {
            stars.forEach(s => {
                s.classList.remove('text-yellow-300');
            });
            
            // Restore selected rating
            if (ratingInput.value) {
                stars.forEach((s, i) => {
                    if (i < ratingInput.value) {
                        s.classList.add('text-yellow-400');
                    }
                });
            }
        });
    });
});
</script>
@endsection