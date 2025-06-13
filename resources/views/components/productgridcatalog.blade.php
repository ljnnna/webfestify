        <!-- Product 1 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="{{ $product->main_image_url }}"
                    alt="{{ $product->name }}"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">{{ $product->name }}</h3>
                    <p class="text-[#493862] text-xs">
                        Rp{{ number_format($product->price, 0, ',', '.') }}/day
                    </p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>
