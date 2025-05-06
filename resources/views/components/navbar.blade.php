<nav class="shadow-md shadow-[#D9C9F9] flex items-center justify-between px-4 sm:px-6 md:px-10 py-4"
     style="background: linear-gradient(to right, #eae1f9, #f5edfb)">
    <div class="flex items-center space-x-6">
        <img src="{{ asset('images/logofestify.png') }}" alt="Festify" class="h-10 w-auto">
        <ul class="hidden md:flex space-x-8 text-[#493862] font-semibold text-base">
            <li><a class="hover:underline" href="#">HOME</a></li>
            <li><a class="hover:underline" href="#">PRODUCT</a></li>
            <li><a class="hover:underline" href="#">ABOUT US</a></li>
            <li><a class="hover:underline" href="#">CONTACT</a></li>
        </ul>
    </div>
    <div class="flex items-center space-x-6">
        <div class="relative w-64 hidden md:block">
            <input type="search" placeholder="Search"
                   class="w-full rounded-full py-2 pl-4 pr-10 text-sm text-[#493862] font-normal shadow-[0_4px_10px_rgba(0,0,0,0.1)] focus:outline-none"/>
            <button class="absolute right-3 top-1/2 -translate-y-1/2 text-[#3B2F5C]">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <button class="text-[#3B2F5C] text-xl"><i class="fas fa-shopping-cart"></i></button>
        <button class="bg-white rounded-full p-2 text-[#3B2F5C] text-xl"><i class="fas fa-user"></i></button>
    </div>
</nav>
