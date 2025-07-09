@php
    use Illuminate\Support\Str;
@endphp

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

<pre>{{ print_r($return->toArray(), true) }}</pre>
@section('content')
<div class="min-h-screen bg-gray-50 p-4 sm:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Enhanced Return Progress -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-6 border border-gray-100">
            <h2 class="text-xl font-bold text-gray-700 mb-4">
                Returning: {{ $orderProduct->product->name ?? 'Unknown Product' }}
            </h2>
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full mr-4 shadow-md">
                    <i class="fas fa-route text-white text-lg"></i>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Return Status</h3>
                    <p class="text-sm text-gray-500">Track your return process step by step</p>
                </div>
            </div>

            @php
                $rawSteps = [
                    ['status' => 'Photos Uploaded', 'icon' => 'camera', 'description' => 'Upload item condition photos'],
                    ['status' => 'Review Submitted', 'icon' => 'star', 'description' => 'Share your rental experience'],
                    ['status' => 'Quality Check', 'icon' => 'search', 'description' => 'Inspecting item condition'],
                    ['status' => 'Item Collected', 'icon' => 'truck', 'description' => 'Item picked up from location'],
                    ['status' => 'Return Completed', 'icon' => 'check-circle', 'description' => 'Process finished successfully'],
                ];

                $photosUploaded = $return && $return->customer_condition_photos && count(json_decode($return->customer_condition_photos, true)) > 0;
                $hasReview = $return && $return->review;
                $photosUploaded = $return && $return->customer_condition_photos && count(json_decode($return->customer_condition_photos, true)) > 0;
                $hasReview = $return && $return->review;
                $hasCondition = $return && $return->product_condition; // ✅ Tambahan logika

                // logika existing
                $hasCondition = $return && $return->product_condition;
                $checked = $return && $return->return_status === 'checked';
                $itemCollected = $return && $return->return_status === 'collected';
                $returnCompleted = in_array($return->return_status, ['done', 'completed']);


                // Hitung step
                $completedUntil = 0;
                if ($photosUploaded) $completedUntil = 1;
                if ($photosUploaded && $hasReview) $completedUntil = 2;
                if ($photosUploaded && $hasReview && $checked) $completedUntil = 3;
                if ($photosUploaded && $hasReview && $itemCollected) $completedUntil = 4;
                if ($returnCompleted) $completedUntil = 5;

                $steps = collect($rawSteps)->map(function($step, $i) use ($completedUntil) {
                    return [
                        ...$step,
                        'completed' => $i < $completedUntil,
                        'current' => $i === $completedUntil,
                    ];
                });

                $photosFromDB = [];
                $hasUploaded = false;
                if ($return && $return->customer_condition_photos) {
                    $decoded = is_string($return->customer_condition_photos)
                        ? json_decode($return->customer_condition_photos, true)
                        : $return->customer_condition_photos;

                    if (is_array($decoded)) {
                        $photosFromDB = $decoded;
                        $hasUploaded = count($photosFromDB) > 0;
                    }
                }
            @endphp

            <div class="relative">
                <div class="absolute top-5 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-purple-600 z-0 rounded-full"></div>

                <div class="relative z-10 flex justify-between">
                    @foreach($steps as $index => $step)
                        <div class="flex flex-col items-center w-1/5">
                            <div class="mb-2 relative">
                                @if($step['completed'])
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-green-500 to-teal-400 flex items-center justify-center text-white font-bold ring-4 ring-white shadow-lg">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-green-100 text-green-800 text-xs px-2 py-0.5 rounded-full">
                                        Completed
                                    </div>
                                @elseif($step['current'])
                                    <div class="h-12 w-12 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white font-bold ring-4 ring-white shadow-lg scale-110 animate-pulse">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-blue-100 text-blue-800 text-xs px-2 py-0.5 rounded-full">
                                        In Progress
                                    </div>
                                @else
                                    <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold ring-4 ring-white shadow-sm">
                                        {{ $index + 1 }}
                                    </div>
                                @endif
                            </div>
                            <div class="text-center px-2 mt-6">
                                <p class="text-xs font-semibold {{ $step['current'] ? 'text-blue-600' : ($step['completed'] ? 'text-green-600' : 'text-gray-500') }} uppercase tracking-wider">
                                    Step {{ $index + 1 }}
                                </p>
                                <p class="text-sm font-medium text-gray-800 mt-1">{{ $step['status'] }}</p>
                                <p class="text-xs text-gray-500 mt-1 leading-tight">{{ $step['description'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <!-- SIDEBAR (akan tampil di kanan saat layar besar) -->
    <div class="lg:col-span-4 space-y-6 order-last lg:order-last">
        @include('components.penalty')
        @include('components.need-help')
    </div>

    <!-- KONTEN UTAMA -->
    <div class="lg:col-span-8 space-y-6 order-first lg:order-first">
        <div class="bg-white rounded-xl shadow-md p-6 border border-gray-100">
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded-md border border-green-300 text-sm shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

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
                    <div 
                        class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center bg-gray-50 relative {{ $hasUploaded ? 'opacity-50 pointer-events-none' : 'cursor-pointer hover:border-blue-400 transition-colors' }}"
                        onclick="{{ !$hasUploaded ? 'document.getElementById(\'photoInput\').click()' : '' }}"
                    >
                        <input type="file" id="photoInput" name="condition_photos[]" multiple accept="image/*" class="hidden" {{ $hasUploaded ? 'disabled' : '' }}>
                        <div id="uploadArea">
                            @if($hasUploaded)
                                <div class="text-green-600 flex flex-col items-center">
                                    <i class="fas fa-check-circle text-4xl mb-2"></i>
                                    <p class="text-sm font-medium">Photos Uploaded</p>
                                </div>
                            @else
                                <i class="fas fa-cloud-upload-alt text-3xl text-blue-400 mb-3"></i>
                                <p class="text-gray-600 text-sm mb-1">Click or drag photos to upload</p>
                                <p class="text-xs text-gray-500">Max 5 photos (JPEG, PNG) • 5MB each</p>
                            @endif
                        </div>
                    </div>

                    <div id="photoPreview" class="grid grid-cols-2 sm:grid-cols-3 gap-3 hidden"></div>

                    @if(!$hasUploaded)
                        <button type="submit" id="uploadBtn" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-2.5 px-4 rounded-lg font-medium hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed shadow-md" disabled>
                            <i class="fas fa-upload mr-2"></i>
                            Upload Photos
                        </button>
                    @endif
                </div>

                @if($hasUploaded)
                    <div class="mt-6">
                        <h3 class="text-sm font-semibold text-gray-700 mb-2">Uploaded Photos</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($photosFromDB as $photo)
                                <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ asset('storage/return_condition/' . $photo) }}" alt="Uploaded Photo" class="w-full h-28 object-cover object-center">
                                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 truncate">
                                        {{ Str::limit($photo, 20) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </form>
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

        @include('components.foto-condition')
        @include('components.pickup-information')
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const photoInput = document.getElementById('photoInput');
    const photoPreview = document.getElementById('photoPreview');
    const uploadBtn = document.getElementById('uploadBtn');

    photoInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);

        if (files.length > 5) {
            alert('Maximum 5 photos allowed');
            photoInput.value = '';
            photoPreview.innerHTML = '';
            photoPreview.classList.add('hidden');
            uploadBtn.disabled = true;
            return;
        }

        displayPhotoPreview(files);
        uploadBtn.disabled = files.length === 0;
    });

    function displayPhotoPreview(files) {
        photoPreview.innerHTML = '';
        photoPreview.classList.remove('hidden');

        files.forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative group rounded-lg overflow-hidden border border-gray-200';
                div.innerHTML = `
                    <img src="${e.target.result}" class="w-full h-28 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs p-2 truncate">
                        ${file.name.substring(0, 20)}${file.name.length > 20 ? '...' : ''}
                    </div>
                `;
                photoPreview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    }

    document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
        const files = photoInput.files;
        if (!files || files.length === 0) {
            e.preventDefault();
            alert('Please upload at least one photo before submitting.');
            return;
        }

        uploadBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Uploading...';
        uploadBtn.disabled = true;
    });
});
</script>
@endsection
