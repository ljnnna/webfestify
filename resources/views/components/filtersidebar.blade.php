<!-- Filter Button (selalu ada) -->
<div class="mb-6">
    <button onclick="openFilterDrawer()"
        class="flex items-center space-x-2 bg-[#6D5983] text-white px-4 py-2 rounded-lg hover:bg-[#5a4a75] transition">
        <i class="fas fa-filter"></i>
        <span>Filter</span>
    </button>
</div>

<!-- Overlay -->
<div id="filter-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="closeFilterDrawer()"></div>

<!-- Filter Sidebar (selalu tersembunyi, muncul sebagai drawer) -->
<aside id="filter-sidebar"
    class="fixed top-0 left-0 w-80 h-full bg-gradient-to-b from-[#FDE9FF] to-[#E6E9FF] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out overflow-auto p-6 shadow-lg">
    
    <!-- Header dengan tombol close -->
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-[#34006C] font-semibold text-2xl">Filter</h2>
        <button onclick="closeFilterDrawer()" class="text-[#34006C] text-xl hover:text-[#6B5B8A] transition">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Divider -->
    <div class="border-b border-[#3B2F5C] mb-4"></div>

    <!-- FORM -->
    <form method="GET" action="{{ route('search.result') }}">
    <input type="hidden" name="query" value="{{ request('query') }}">

        <!-- Category Section -->
        <section class="mb-8">
            <h3 class="text-[#34006C] font-semibold mb-3">Category</h3>
            <div class="space-y-3 text-[#493862] text-sm font-normal">
                <label class="flex items-center space-x-2">
                    <input type="radio" name="category" value="Electronics" class="accent-[#493862]"
                        {{ request('category') === 'Electronics' ? 'checked' : '' }}>
                    <span>Electronics</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="category" value="Merchandise" class="accent-[#493862]"
                        {{ request('category') === 'Merchandise' ? 'checked' : '' }}>
                    <span>Merchandise</span>
                </label>
            </div>
        </section>

        <!-- Price Section -->
        <section class="mb-6">
            <h3 class="text-[#34006C] font-semibold mb-3">Price</h3>
            <input
    id="priceRange"
    type="range"
    name="max_price"
    min="0"
    max="500000"
    value="{{ request('max_price', 250000) }}"
    class="w-full accent-[#6B5B8A]"
    oninput="updatePriceValue(this.value)"
/>
<p class="text-xs text-[#493862] mt-1">Max: <span id="priceValue">Rp{{ number_format(request('max_price', 250000)) }}</span></p>

        </section>

        <!-- Reset Button (optional) -->
        <a href="{{ route('search.result', ['query' => request('query')]) }}"
            class="block w-full bg-[#6D5983] text-white font-bold py-3 rounded-lg hover:bg-[#5a4a75] text-center transition">
            RESET
        </a>

        <!-- Apply Button -->
        <button type="submit"
            class="w-full mt-3 bg-[#B6A3E6] text-[#2E1B5F] font-bold py-3 rounded-lg hover:bg-[#9A85E0] transition">
            APPLY FILTERS
        </button>
    </form>
</aside>

<!-- Script -->
<script>
function openFilterDrawer() {
    const sidebar = document.getElementById('filter-sidebar');
    const overlay = document.getElementById('filter-overlay');

    sidebar.classList.remove('-translate-x-full');
    overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeFilterDrawer() {
    const sidebar = document.getElementById('filter-sidebar');
    const overlay = document.getElementById('filter-overlay');

    sidebar.classList.add('-translate-x-full');
    overlay.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.addEventListener('click', function(event) {
    const sidebar = document.getElementById('filter-sidebar');
    const overlay = document.getElementById('filter-overlay');
    const filterButton = event.target.closest('button[onclick="openFilterDrawer()"]');

    if (!sidebar.contains(event.target) && !filterButton && !overlay.classList.contains('hidden')) {
        closeFilterDrawer();
    }
});
</script>

<script>
    function updatePriceValue(val) {
        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(val);
        document.getElementById('priceValue').textContent = formatted;
    }
</script>

