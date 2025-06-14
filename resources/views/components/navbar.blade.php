<header class="fixed top-0 left-0 w-full z-50 bg-[#E9DFF7] shadow-md text-[#3E3667]">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
        <div class="flex items-center space-x-6">
            <img alt="Festify logo" src="{{ asset('images/logofestify.png') }}" width="100" height="80" />
            <nav class="hidden md:flex space-x-8 font-semibold text-sm">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 rounded-xl transition {{ request()->is('dashboard') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">HOME</a>
                <a href="{{ route('catalog') }}"
                    class="px-4 py-2 rounded-xl transition {{ request()->is('catalog') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">CATALOG</a>
                <a href="{{ route('team') }}"
                    class="px-4 py-2 rounded-xl transition {{ request()->is('team') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">ABOUT US</a>
                <a href="{{ route('contact') }}"
                    class="px-4 py-2 rounded-xl transition {{ request()->is('contact') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:opacity-60' }}">CONTACT</a>
            </nav>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Search -->
            <div class="relative w-[280px] hidden sm:block">
                <input type="text" placeholder="Search..."
                    class="w-full rounded-full py-2 pl-4 pr-10 text-sm bg-white text-[#3E3667] focus:outline-none shadow-inner">
                <i class="fas fa-search absolute right-3 top-2.5 text-gray-500"></i>
            </div>

            <!-- Icons -->
            <a href="{{ route('cart') }}" aria-label="Cart" class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl">
                <i class="fas fa-shopping-cart"></i>
            </a>

            @auth
            <!-- Profile Dropdown for Desktop -->
            <div class="hidden sm:block relative">
                <button onclick="toggleProfileDropdown()" aria-label="User Profile"
                    class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl focus:outline-none">
                    <i class="fas fa-user-circle"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="profile-dropdown"
                    class="hidden absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
                    <div class="py-2">
                        <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-100">
                            <div class="font-medium">{{ Auth::user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                        </div>
                        <a href="{{ route('home') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#B6A3E6] hover:text-[#2E1B5F] transition">
                            Home
                        </a>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-[#B6A3E6] hover:text-[#2E1B5F] transition">
                            Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit"
                                class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-[#B6A3E6] hover:text-[#2E1B5F] transition">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <!-- Guest User Icon -->
            <a href="{{ route('profile.edit') }}" aria-label="User"
                class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl">
                <i class="fas fa-user-circle"></i>
            </a>
            @endauth

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
            class="px-4 py-2 rounded-xl transition {{ request()->is('dashboard') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">HOME</a>
        <a href="{{ route('catalog') }}"
            class="px-4 py-2 rounded-xl transition {{ request()->is('catalog') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">CATALOG</a>
        <a href="{{ route('team') }}"
            class="px-4 py-2 rounded-xl transition {{ request()->is('team') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">ABOUT US</a>
        <a href="{{ route('contact') }}"
            class="px-4 py-2 rounded-xl transition {{ request()->is('contact') ? 'bg-[#B6A3E6] text-[#2E1B5F] font-bold' : 'hover:bg-gray-100' }}">CONTACT</a>

        @auth
        <!-- Mobile Profile Section -->
        <div class="border-t border-gray-200 pt-4 mt-4">
            <div class="text-gray-800 font-medium mb-2">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500 mb-3">{{ Auth::user()->email }}</div>

            <a href="{{ route('home') }}"
                class="block px-4 py-2 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition">
                Home
            </a>
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-2 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition">
                Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit"
                    class="block w-full text-left px-4 py-2 rounded-xl text-sm text-gray-700 hover:bg-gray-100 transition">
                    Log Out
                </button>
            </form>
        </div>
        @endauth
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

function toggleProfileDropdown() {
    const dropdown = document.getElementById('profile-dropdown');
    dropdown.classList.toggle('hidden');
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    const dropdown = document.getElementById('profile-dropdown');
    const profileButton = event.target.closest('[onclick="toggleProfileDropdown()"]');

    if (!profileButton && !dropdown.contains(event.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>