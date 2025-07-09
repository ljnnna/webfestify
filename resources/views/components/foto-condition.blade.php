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

    
    @php
        $afterPhotos = is_string($return->condition_after)
            ? json_decode($return->condition_after, true)
            : $return->condition_after;

        $conditionLabel = ucfirst($return->product_condition ?? 'Unknown');
        $conditionColor = match($return->product_condition) {
            'excellent' => 'bg-green-100 text-green-800',
            'good' => 'bg-blue-100 text-blue-800',
            'fair' => 'bg-yellow-100 text-yellow-800',
            'poor' => 'bg-orange-100 text-orange-800',
            'damaged' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-700',
        };
    @endphp

    {{-- Photo Grid --}}
    @if(!empty($afterPhotos))
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4">
            @foreach($afterPhotos as $photo)
                <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                    <img src="{{ asset('storage/conditions/' . $photo) }}" 
                         class="w-full h-28 object-cover"
                         alt="Return condition photo {{ $loop->iteration }}">
                    <a href="{{ asset('storage/conditions/' . $photo) }}" 
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
        <div class="p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-700 rounded-md mb-4">
            <p class="text-sm">No return photos available yet. Please check back after verification is complete.</p>
        </div>
    @endif

    {{-- Product Condition --}}
    <div class="flex items-center gap-2 mb-2">
        <span class="text-sm font-medium text-gray-700">Product Condition:</span>
        <span class="text-xs font-semibold px-3 py-1 rounded-full {{ $conditionColor }}">
            {{ $conditionLabel }}
        </span>
    </div>

    {{-- Notes --}}
    @if($return->condition_notes)
        <div class="mt-2 bg-gray-50 rounded-lg p-4 border border-gray-100">
            <h4 class="text-sm font-medium text-gray-700 mb-2 flex items-center">
                <i class="fas fa-clipboard-list text-blue-500 mr-2"></i>
                Admin Notes:
            </h4>
            <p class="text-sm text-gray-600">{{ $return->condition_notes }}</p>
        </div>
    @endif
</div>
