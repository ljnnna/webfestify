<aside class="w-80 bg-gradient-to-b from-pink-100 via-pink-50 to-blue-100 border-r border-purple-100 flex flex-col min-h-screen">
    <div class="p-8 flex flex-col items-center">
        <!-- Profile Picture Container -->
        <div class="relative mb-6">
            <div class="w-32 h-32 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 p-1 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <x-profile-picture-upload :user="auth()->user()" class="w-full h-full rounded-full object-cover border-4 border-white hover:border-purple-200 transition-all duration-300" />
            </div>
        </div>

        <!-- User Info -->
        <div class="text-center mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-1 transition-colors duration-300 hover:text-purple-600">{{ auth()->user()->name ?? 'User Name' }}</h3>
            <p class="text-sm text-gray-600 transition-colors duration-300 hover:text-purple-500">{{ auth()->user()->email ?? 'user@example.com' }}</p>
        </div>

        <!-- Navigation Menu -->
        <nav class="w-full space-y-3">
            <a href="{{ route('profile.edit') }}"
               class="group relative flex items-center px-6 py-3 rounded-xl transition-all duration-300 ease-in-out overflow-hidden
               {{ request()->routeIs('profile.edit') ? 
                  'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-md' : 
                  'bg-white/70 hover:bg-white text-gray-700 shadow-sm hover:shadow-md' }}">
                
                <!-- Subtle hover background effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-400 opacity-0 group-hover:opacity-10 transition-opacity duration-300 rounded-xl"></div>
                
                <!-- Sparkle Effects (more subtle) -->
                <div class="absolute top-2 right-3 w-1.5 h-1.5 bg-yellow-300 rounded-full opacity-0 group-hover:opacity-80 group-hover:animate-pulse transition-all duration-500 delay-75"></div>
                
                <svg class="w-5 h-5 mr-3 relative z-10 transition-all duration-200 group-hover:scale-110 
                    {{ request()->routeIs('profile.edit') ? 'text-white' : 'text-purple-500 group-hover:text-pink-500' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="font-medium relative z-10 transition-colors duration-200 {{ request()->routeIs('profile.edit') ? '' : 'group-hover:text-purple-600' }}">Account Setting</span>
                <svg class="w-4 h-4 ml-auto relative z-10 transition-all duration-200 
                    {{ request()->routeIs('profile.edit') ? 'text-white rotate-90' : 'text-gray-400 group-hover:text-pink-500 group-hover:translate-x-1' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>

            <a href="{{ route('profile.rentalInfo') }}"
               class="group relative flex items-center px-6 py-3 rounded-xl transition-all duration-300 ease-in-out overflow-hidden
               {{ request()->routeIs('profile.rentalInfo') ? 
                  'bg-gradient-to-r from-purple-500 to-pink-500 text-white shadow-md' : 
                  'bg-white/70 hover:bg-white text-gray-700 shadow-sm hover:shadow-md' }}">
                
                <!-- Subtle hover background effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-400 opacity-0 group-hover:opacity-10 transition-opacity duration-300 rounded-xl"></div>
                
                <!-- Animated Background Effect -->
                <div class="absolute inset-0 bg-gradient-to-r from-purple-400 to-pink-400 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                
                <!-- Sparkle Effect -->
                <div class="absolute top-1 right-1 w-2 h-2 bg-yellow-300 rounded-full opacity-0 group-hover:opacity-100 group-hover:animate-pulse transition-all duration-700"></div>
                <div class="absolute top-3 right-6 w-1 h-1 bg-white rounded-full opacity-0 group-hover:opacity-100 group-hover:animate-ping transition-all duration-500 delay-100"></div>
                
                <svg class="w-5 h-5 mr-3 relative z-10 transition-all duration-200 group-hover:scale-110 
                    {{ request()->routeIs('profile.rentalInfo') ? 'text-white' : 'text-purple-500 group-hover:text-pink-500' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span class="font-medium relative z-10 transition-colors duration-200 {{ request()->routeIs('profile.rentalInfo') ? '' : 'group-hover:text-purple-600' }}">Rental Information</span>
                <svg class="w-4 h-4 ml-auto relative z-10 transition-all duration-200 
                    {{ request()->routeIs('profile.rentalInfo') ? 'text-white rotate-90' : 'text-gray-400 group-hover:text-pink-500 group-hover:translate-x-1' }}" 
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </nav>
    </div>
</aside>