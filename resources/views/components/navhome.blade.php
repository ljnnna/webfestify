<header class="fixed top-0 left-0 w-full z-50 bg-[#E9DFF7] shadow-md text-[#3E3667]">

    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
        <div class="flex items-center space-x-6">
            <img alt="Festify logo" src="{{ asset('images/logofestify.png') }}" width="100" height="80" />
        </div>

        <!-- Menu -->
        <nav class="hidden md:flex space-x-8 font-semibold text-sm absolute left-1/2 transform -translate-x-1/2">
            <a href="{{ route('home') }}"
                class="px-4 py-2 rounded-xl transition {{ request()->is('home') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">HOME</a>
            <a href="{{ route('catalog') }}"
                class="px-4 py-2 rounded-xl transition {{ request()->is('catalog') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">CATALOG</a>
            <a href="{{ url('about_us') }}"
                class="px-4 py-2 rounded-xl transition {{ request()->is('about_us') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">ABOUT US</a>
            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=festify2b@gmail.com"
                class="px-4 py-2 rounded-xl transition hover:opacity-60">CONTACT</a>
        </nav>

        <div class="flex items-center space-x-4">
            <!-- Icons -->
            <a href="{{ url('chart') }}" aria-label="Cart" class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl">
                <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="{{ route('profile.edit') }}" aria-label="User" class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl">
                <i class="fas fa-user-circle"></i>
            </a>
            <!-- Mobile Menu Button -->
            <button onclick="openDrawer()" aria-label="Open menu"
                class="md:hidden text-[#3E3667] text-2xl focus:outline-none">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>

<!-- Spacer agar konten tidak tertutup navbar -->
<div class="h-16"></div>

<!-- Overlay -->
<div id="drawer-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="closeDrawer()"></div>

<!-- Drawer dari kanan -->
<aside id="mobile-drawer"
    class="fixed top-0 right-0 w-64 h-full bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-between p-4 border-b border-gray-200">
        <h2 class="font-bold text-lg">Menu</h2>
        <button onclick="closeDrawer()" class="text-xl text-gray-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <nav class="flex flex-col p-4 space-y-4 font-semibold text-sm">
        <a href="{{ route('home') }}"
            class="px-4 py-2 rounded-xl transition {{ request()->is('home') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">HOME</a>
        <a href="{{ route('catalog') }}"
            class="px-4 py-2 rounded-xl transition {{ request()->is('catalog') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">CATALOG</a>
        <a href="{{ url('about_us') }}"
            class="px-4 py-2 rounded-xl transition {{ request()->is('about_us') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">ABOUT
            US</a>
        <a href="https://mail.google.com/mail/?view=cm&fs=1&to=festify2b@gmail.com"
            class="px-4 py-2 rounded-xl transition hover:bg-gray-100">CONTACT</a>
    </nav>


</aside>

<script>
function openDrawer() {
    document.getElementById('mobile-drawer').classList.remove('translate-x-full');
    document.getElementById('drawer-overlay').classList.remove('hidden');
}

function closeDrawer() {
    document.getElementById('mobile-drawer').classList.add('translate-x-full');
    document.getElementById('drawer-overlay').classList.add('hidden');
}
</script>