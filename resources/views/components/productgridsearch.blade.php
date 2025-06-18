@forelse ($results as $product)
<article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full">
    <div class="flex-shrink-0 mb-4">
        <img 
            src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x200?text=No+Image' }}" 
            alt="{{ $product->name }}"
            class="rounded-xl w-full h-48 object-cover" />
    </div>
    <div class="flex flex-col flex-grow justify-between">
        <div class="mb-4">
            <h3 class="text-[#493862] font-semibold text-sm mb-2">
                {{ $product->name }}
            </h3>
            <p class="text-[#493862] text-xs">
                Rp{{ number_format($product->price_per_day ?? 0, 0, ',', '.') }}/day
            </p>
        </div>
        <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto">
            Details
        </a>
    </div>
</article>
@empty
<div class="col-span-full text-center text-gray-500">
    No products found for your search.
</div>
@endforelse
