<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-gradient-to-b from-purple-200 via-purple-50 to-purple-200 border-b border-purple-200 shadow dark:bg-gray-600 dark:border-gray-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logofestify.png') }}" class="h-12 w-auto" alt="Festify Logo" />
                </a>
                <span class="text-1xl font-semibold text-purple-800 dark:text-white">Festify</span>
            </div>

            <!-- Desktop Menu -->
            @yield('desktop-menu')

            <!-- Right Section -->
            <div class="flex items-center space-x-4">

                <!-- Cart Icon -->
                <a href="{{ route('cart') }}" aria-label="Cart" class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl">
                <i class="fas fa-shopping-cart"></i>
            </a>

                @auth
                <!-- User Dropdown -->
                <div class="hidden sm:flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center focus:outline-none">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-purple-400"
                                src="{{ Auth::user()->picture ? asset('storage/' . Auth::user()->picture) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=8b5cf6&color=fff' }}"
                                 alt="User Avatar">
                            </button>
                        </x-slot>

                        <x-slot name="content">
    {{-- User Info --}}
    <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-100">
        <div class="font-medium">{{ Auth::user()->name }}</div>
        <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
    </div>

    {{-- Menu Links --}}
    <x-dropdown-link :href="route('home')">
        {{ __('Home') }}
    </x-dropdown-link>
    <x-dropdown-link :href="route('profile.edit')">
        {{ __('Profile') }}
    </x-dropdown-link>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); 
        if (confirm('Are you sure you want to log out?')) {
            this.closest('form').submit();
        }">
        {{ __('Log Out') }}
    </x-dropdown-link>
</form>

</x-slot>

                    </x-dropdown>
                </div>
                @else
                    <!-- Guest Buttons -->
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-gray-800 dark:text-white hover:bg-gray-50 font-medium rounded-lg text-sm px-4 py-2 dark:hover:bg-gray-700">
                            Register
                        </a>
                    @endif
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-white bg-purple-500 hover:bg-purple-600 font-medium rounded-lg text-sm px-4 py-2 dark:bg-purple-600 dark:hover:bg-purple-700">
                            Get Started
                        </a>
                    @endif
                @endauth

                <!-- Mobile Menu Toggle -->
                <div class="lg:hidden">
                    <button @click="open = ! open" class="text-gray-700 dark:text-gray-300 hover:text-purple-700 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="lg:hidden hidden px-4 pt-2 pb-4 space-y-2">
        <a href="#" class="block text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Welcome</a>
        <a href="#" class="block text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Marketplace</a>
        <a href="/team" class="block text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Team</a>
        <a href="#" class="block text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Contact</a>

        @auth
        <div class="border-t border-gray-200 dark:border-gray-600 pt-2">
            <div class="text-gray-800 dark:text-white font-medium">{{ Auth::user()->name }}</div>
            <div class="text-sm text-gray-500 dark:text-gray-300">{{ Auth::user()->email }}</div>

            <a href="{{ route('home') }}" class="block mt-2 text-sm text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Home</a>
            <a href="{{ route('profile.edit') }}" class="block text-sm text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Profile</a>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="block text-sm text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">
                    Log Out
                </button>
            </form>
        </div>
        @endauth
    </div>
</nav>