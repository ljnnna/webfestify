<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-200 to-purple-100 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logofestify.png') }}" class="h-8 w-auto mr-2" alt="Festify Logo" />
                </a>
                <span class="text-xl font-semibold text-gray-800 dark:text-white">Festify</span>
            </div>

            <!-- Desktop Menu -->
            {{-- Desktop menu akan dimasukkan di sini --}}
            @yield('desktop-menu')
            <!-- <div class="hidden lg:flex space-x-6 items-center">
                <a href="#" class="text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Welcome</a>
                <a href="#" class="text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Marketplace</a>
                <a href="/team" class="text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Team</a>
                <a href="#" class="text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white">Contact</a>
            </div> -->

            <!-- Right Section -->
            <div class="flex items-center space-x-4">
                @auth
                    <!-- Desktop User Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-700 dark:text-white bg-white dark:bg-gray-800 hover:text-purple-700 focus:outline-none transition ease-in-out duration-150">
                                    <div>{{ Auth::user()->name }}</div>
                                    <div class="ml-2">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('home')">
                                    {{ __('home') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Login / Register for guests -->
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

                <!-- Mobile Toggle -->
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
