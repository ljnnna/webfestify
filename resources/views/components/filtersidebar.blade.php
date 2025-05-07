<aside
    class="bg-gradient-to-b from-[#FDE9FF] to-[#E6E9FF] rounded-xl p-6 w-full max-w-sm shadow-md shadow-[#D9C9F9] max-h-[400px] overflow-auto"
>
    <h2
        class="text-[#34006C] font-semibold text-2xl mb-4 border-b border-[#3B2F5C] pb-2"
    >
        Filter
    </h2>
    <section class="mb-8">
        <h3 class="text-[#34006C] font-semibold mb-3">Category</h3>
        <form class="space-y-3 text-[#493862] text-sm font-normal">
            <label class="flex items-center space-x-2">
                <input type="radio" name="category" class="accent-[#493862]" />
                <span>Electronics</span>
            </label>
            <label class="flex items-center space-x-2">
                <input
                    type="radio"
                    name="category"
                    class="accent-[#493862]"
                    checked
                />
                <span>Merchandise</span>
            </label>
        </form>
    </section>
    <section class="mb-6">
        <h3 class="text-[#34006C] font-semibold mb-3">Price</h3>
        <input
            type="range"
            min="0"
            max="500000"
            value="250000"
            class="w-full accent-[#6B5B8A]"
        />
        <p class="text-xs text-[#493862] mt-1">0 - 500000</p>
    </section>
    <button
        class="w-full bg-[#6D5983] text-white font-bold py-3 rounded-lg hover:bg-[#5a4a75] transition"
    >
        RESET
    </button>
</aside>
