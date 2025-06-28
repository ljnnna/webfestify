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
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Return by Pickup</h1>
                    <p class="text-gray-600">Order #{{ $order->order_code ?? $order->id }}</p>
                </div>
                <div class="text-right">
                    <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-3 py-1 rounded-full">
                        Pickup Requested
                    </span>
                </div>
            </div>
            
            <!-- Order Summary -->
            @php
                $product = $order->products->first();
            @endphp
            <div class="border-t pt-4">
                <div class="flex items-center space-x-4">
                    <img src="{{ $product && $product->image ? asset('storage/' . $product->image) : asset('images/no-image.jpg') }}"
                         alt="{{ $product?->name ?? 'No product' }}"
                         class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-900">{{ $product?->name ?? 'Product' }}</h3>
                        <p class="text-gray-600 text-sm">Rental Period: {{ $order->start_date->format('d M Y') }} - {{ $order->end_date->format('d M Y') }}</p>
                        <p class="text-gray-600 text-sm">Total Amount: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Photo Upload Section -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-camera text-purple-600 mr-2"></i>
                        Item Condition Photos
                    </h2>
                    <p class="text-gray-600 mb-6">Please upload photos of the item's current condition before pickup. This helps us process your return faster.</p>
                    
                    <form id="photoUploadForm" method="POST" action="{{ route('return.upload-photos', $order->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-4">
                            <!-- Photo Upload Area -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-400 transition-colors">
                                <input type="file" id="photoInput" name="condition_photos[]" multiple accept="image/*" class="hidden">
                                <div id="uploadArea" class="cursor-pointer" onclick="document.getElementById('photoInput').click()">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <p class="text-gray-600 mb-2">Click to upload photos</p>
                                    <p class="text-sm text-gray-500">Maximum 5 photos, each up to 5MB</p>
                                </div>
                            </div>

                            <!-- Photo Preview -->
                            <div id="photoPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-4 hidden"></div>

                            <!-- Upload Button -->
                            <button type="submit" id="uploadBtn" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-purple-600 hover:to-pink-600 transition-all disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                                <i class="fas fa-upload mr-2"></i>
                                Upload Photos
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Pickup Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">
                        <i class="fas fa-truck text-blue-600 mr-2"></i>
                        Pickup Information
                    </h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pickup Address</label>
                                <p class="text-gray-900">{{ $order->delivery_address ?? auth()->user()->address ?? 'Address not set' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number</label>
                                <p class="text-gray-900">{{ auth()->user()->phone ?? 'Phone not set' }}</p>
                            </div>
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h4 class="font-semibold text-blue-900 mb-2">Pickup Instructions:</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li>• Our courier will contact you 30 minutes before pickup</li>
                                <li>• Please have the item ready and accessible</li>
                                <li>• Ensure someone is available at the pickup address</li>
                                <li>• Keep your phone accessible for courier communication</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Return Tracking -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-2xl shadow-lg p-6 border border-blue-200">
                    <div class="flex items-center mb-6">
                        <div class="bg-blue-500 rounded-full p-2 mr-3">
                            <i class="fas fa-route text-white text-sm"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Return Tracking</h3>
                    </div>
                    
                    <div class="relative">
                        @php
                            $trackingSteps = [
                                ['status' => 'Photos Required', 'completed' => false, 'current' => true, 'icon' => 'camera'],
                                ['status' => 'Pickup Scheduled', 'completed' => false, 'current' => false, 'icon' => 'calendar-check'],
                                ['status' => 'Item Collected', 'completed' => false, 'current' => false, 'icon' => 'truck'],
                                ['status' => 'Quality Check', 'completed' => false, 'current' => false, 'icon' => 'search'],
                                ['status' => 'Return Completed', 'completed' => false, 'current' => false, 'icon' => 'check-circle'],
                            ];
                        @endphp
                        
                        <!-- Progress Line -->
                        <div class="absolute left-5 top-8 bottom-8 w-0.5 bg-gray-300"></div>
                        
                        <div class="space-y-6">
                            @foreach($trackingSteps as $index => $step)
                                <div class="flex items-start space-x-4 relative">
                                    <!-- Step Icon -->
                                    <div class="flex-shrink-0 relative z-10">
                                        @if($step['completed'])
                                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                                <i class="fas fa-check text-white text-sm"></i>
                                            </div>
                                        @elseif($step['current'])
                                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg animate-pulse">
                                                <i class="fas fa-{{ $step['icon'] }} text-white text-xs"></i>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                <i class="fas fa-{{ $step['icon'] }} text-gray-500 text-xs"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Step Content -->
                                    <div class="flex-1 min-w-0 pb-4">
                                        <div class="flex items-center justify-between">
                                            <h4 class="text-sm font-semibold {{ $step['current'] ? 'text-blue-700' : ($step['completed'] ? 'text-green-700' : 'text-gray-600') }}">
                                                {{ $step['status'] }}
                                            </h4>
                                            @if($step['current'])
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Current
                                                </span>
                                            @elseif($step['completed'])
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    Done
                                                </span>
                                            @endif
                                        </div>
                                        
                                        <!-- Step Description -->
                                        <p class="text-xs text-gray-500 mt-1">
                                            @switch($step['status'])
                                                @case('Photos Required')
                                                    Upload photos of item condition
                                                    @break
                                                @case('Pickup Scheduled')
                                                    Courier will be assigned
                                                    @break
                                                @case('Item Collected')
                                                    Item picked up from location
                                                    @break
                                                @case('Quality Check')
                                                    Inspecting item condition
                                                    @break
                                                @case('Return Completed')
                                                    Process finished successfully
                                                    @break
                                            @endswitch
                                        </p>
                                        
                                        @if($step['current'])
                                            <div class="mt-2">
                                                <div class="flex items-center text-xs text-blue-600">
                                                    <div class="animate-spin rounded-full h-3 w-3 border-b-2 border-blue-600 mr-2"></div>
                                                    In Progress
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

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
                                *Penalties will be determined by admin after item evaluation
                            </p>
                        </div>
                    </div>
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
                    div.className = 'relative group';
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg">
                        <button type="button" onclick="removePhoto(${index})" 
                                class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-1 rounded-b-lg truncate">
                            ${file.name}
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
        
        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';
        uploadBtn.disabled = true;
    });
});
</script>
@endsection