<aside class="w-full md:w-1/4 bg-gradient-to-b from-pink-100 to-blue-100 p-6 md:rounded-r-3xl shadow-md mt-2 md:mt-10">
    <div class="flex flex-col items-center">
        <!-- Gambar Profil -->
        <x-profile-picture-upload :user="auth()->user()" />
        <!-- Menu Navigasi -->
        <nav class="mt-10 space-y-3 text-center font-semibold text-gray-700">
            <a href="{{ route('profile.edit') }}"
               class="block px-3 py-2 rounded-full transition
               {{ request()->routeIs('profile.edit') ? 'bg-white text-purple-800 font-bold' : 'hover:bg-purple-100' }}">
                ACCOUNT SETTING
            </a>
            <a href="{{ route('profile.rentalInfo') }}"
               class="block px-3 py-2 rounded-full transition
               {{ request()->routeIs('profile.rentalInfo') ? 'bg-white text-purple-800 font-bold' : 'hover:bg-purple-100' }}">
                RENTAL INFORMATION
            </a>
        </nav>
    </div>
</aside>