<div class="fixed top-0 left-0 right-0 h-16 flex justify-between items-center p-4 border-b bg-white z-20">
    <div class="flex-1 text-center">
        <img src="{{ asset('images/logofestify.png') }}" alt="Logo" class="mx-auto h-10" />
    </div>
    <div class="flex items-center gap-6 mr-8">
        <a href="#">
            <x-icon name="bell" class="text-[#493862] text-xl hover:text-purple-300 transition duration-200" />
        </a>
        <!-- <a href="#">
            <x-icon name="user" class="text-[#493862] text-xl hover:text-purple-300 transition duration-200" />
        </a> -->

        <div x-data="{ open: false }" class="relative">
    <!-- Icon user -->
    <button @click="open = !open" class="focus:outline-none">
        <x-icon name="user" class="text-[#493862] text-xl hover:text-purple-300 transition duration-200" />
    </button>

    <!-- Pop-out menu -->
    <div 
        x-show="open" 
        @click.away="open = false" 
        x-transition 
        class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg border border-black-700 outline outline-1 outline-black-500 z-50"
    >
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
        >
            <x-icon name="fa-solid fa-right-from-bracket" class="w-4 h-4 mr-2" />
            Logout
        </a>

        <!-- Form untuk logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
    </div>
</div>

<!-- 493862 -->