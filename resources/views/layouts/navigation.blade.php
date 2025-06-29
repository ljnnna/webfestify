<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<nav x-data="{ open: false }" class="sticky top-0 z-50 w-full h-auto bg-gradient-to-b from-purple-200 via-purple-50 to-purple-200 border-b border-purple-200 shadow dark:bg-gray-600 dark:border-gray-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- KIRI: Logo + Desktop Menu -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/logofestify.png') }}" class="h-8 lg:h-12 w-auto" alt="Festify Logo" />
                    </a>
                    <span class="text-base lg:text-x font-semibold text-purple-800 dark:text-white hidden lg:inline">Festify</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-6">
                    @yield('desktop-menu')
                </div>
            </div>

            <!-- KANAN: Search, Cart, Auth (Desktop Only) -->
            <div class="hidden lg:flex items-center space-x-6">
                <!-- Search Input -->
                <form action="{{ url('/search/result') }}" method="GET" class="relative">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Search..." 
                        class="pl-4 pr-10 py-2 rounded-full border border-purple-800 focus:ring-2 focus:ring-purple-300 focus:outline-none w-64 dark:bg-gray-700 dark:text-white"
                    />
                    <button type="submit" 
                        class="absolute right-0 top-0 bottom-0 px-4 rounded-r-full bg-gradient-to-r from-purple-300 to-indigo-200 text-white hover:opacity-90">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>

                <!-- Cart Icon -->
                <a href="{{ route('cart') }}" class="text-[#3E3667] hover:text-[#6B5DD3] text-2xl">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- Auth Section -->
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center focus:outline-none">
                                <img class="h-10 w-10 rounded-full object-cover border-2 border-purple-400"
                                    src="{{ Auth::user()->picture 
                                        ? asset('storage/' . Auth::user()->picture) . '?' . now()->timestamp 
                                        : asset('images/default-user.png') }}"
                                    alt="User Avatar">
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-100">
                                <div class="font-medium">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            <x-dropdown-link :href="route('home')">{{ __('Home') }}</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); if (confirm('Are you sure you want to log out?')) { this.closest('form').submit(); }">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <a href="{{ route('register') }}" class="text-gray-800 dark:text-white hover:bg-gray-50 font-medium rounded-lg text-sm px-4 py-2 dark:hover:bg-gray-700">
                        Register
                    </a>
                    <a href="{{ route('login') }}" class="text-white bg-purple-500 hover:bg-purple-600 font-medium rounded-lg text-sm px-4 py-2 dark:bg-purple-600 dark:hover:bg-purple-700">
                        Get Started
                    </a>
                @endauth
            </div>

            <!-- Mobile Search + Cart -->
            <div class="flex lg:hidden items-center space-x-2 ml-auto">
                <form action="{{ url('/search/result') }}" method="GET">
                    <input 
                        type="text" 
                        name="query" 
                        placeholder="Search..." 
                        class="pl-4 pr-10 py-2 rounded-full border border-purple-800 focus:ring-2 focus:ring-purple-300 focus:outline-none w-44 sm:w-56 dark:bg-gray-700 dark:text-white text-sm"
                    />
                </form>
                <a href="{{ route('cart') }}" class="text-[#3E3667] hover:text-[#6B5DD3] text-xl">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </div>
        </div>
    </div>
</nav>





<!-- Bottom Navbar (Mobile Only) -->
<div class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-gray-800 border-t border-purple-300 dark:border-gray-600 lg:hidden shadow-md">
    <div class="flex justify-around items-center py-2 text-sm">

        <!-- Home -->
        <a href="{{ route('home') }}">
            <i class="fas fa-home text-xl {{ request()->routeIs('home') ? 'text-purple-700 dark:text-purple-400' : 'text-gray-700 dark:text-gray-200 hover:text-purple-600' }}"></i>
        </a>

        <!-- Catalog -->
        <a href="{{ route('catalog') }}">
            <i class="fas fa-store text-xl {{ request()->routeIs('catalog') ? 'text-purple-700 dark:text-purple-400' : 'text-gray-700 dark:text-gray-200 hover:text-purple-600' }}"></i>
        </a>

        <!-- Team -->
        <a href="{{ route('team') }}">
            <i class="fas fa-users text-xl {{ request()->routeIs('team') ? 'text-purple-700 dark:text-purple-400' : 'text-gray-700 dark:text-gray-200 hover:text-purple-600' }}"></i>
        </a>

        <!-- Contact -->
        <a href="{{ route('contact') }}">
            <i class="fas fa-envelope text-xl {{ request()->routeIs('contact') ? 'text-purple-700 dark:text-purple-400' : 'text-gray-700 dark:text-gray-200 hover:text-purple-600' }}"></i>
        </a>
        @auth
<div x-data="{ openProfile: false }" class="relative">
    <button @click="openProfile = !openProfile" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700">
        <i class="fas fa-user text-xl"></i>
    </button>

    <div 
<div 

    x-show="openProfile"
    @click.away="openProfile = false"
    x-transition 
    class="absolute bottom-12 right-0 w-48 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-lg z-50"
>

        <div class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 border-b border-gray-200 dark:border-gray-600">
            <div class="font-medium">{{ Auth::user()->name }}</div>
            <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        <a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700">
            Home
        </a>
        <a href="{{ route('profile.edit') }}" class=" block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700">
            Profile
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button 
                type="submit" 
                onclick="return confirm('Are you sure you want to log out?')" 
                class="w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-purple-100 dark:hover:bg-gray-700"
            >
                Log Out
            </button>
        </form>
    </div>
</div>
@else
    @if (Route::has('login'))
        <a href="{{ route('login') }}" class="text-purple-700 dark:text-purple-400 hover:text-purple-600">
            <i class="fas fa-sign-in-alt text-xl"></i>
        </a>
    @endif
@endauth

    </div>
</div>

