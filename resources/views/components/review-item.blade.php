@php
    use App\Models\ReturnProduct;

    $returns = ReturnProduct::with(['review.user', 'review.product'])->get();
@endphp

@foreach ($returns as $return)
    @if ($return->review)
        <div class="border-b pb-4 mb-4">
            <p class="text-lg font-bold text-[#493862]">
                {{ $return->review->user->name ?? 'Anonymous' }}
            </p>
            <p class="text-sm text-purple-700 font-medium">
                Product: {{ $return->review->product->name ?? '-' }}
            </p>
            <p class="text-sm text-yellow-500 mb-1">
                @for ($i = 1; $i <= 5; $i++)
                    <i class="fas fa-star {{ $i <= $return->review->rating ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                @endfor
            </p>
            <p class="text-sm text-gray-600 italic mb-1">
                "{{ $return->review->review }}"
            </p>
            <p class="text-xs text-gray-400">
                {{ $return->review->created_at->format('d M Y') }}
            </p>
        </div>
    @endif
@endforeach
