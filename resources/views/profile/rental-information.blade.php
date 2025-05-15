<x-app-layout>
        <div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
        <!-- SIDEBAR (Sekarang tampil di mobile juga) -->
        <aside class="w-full md:w-1/4 bg-gradient-to-b from-pink-100 to-blue-100 p-6 md:rounded-r-3xl shadow-md mt-2 md:mt-10">
            <div class="flex flex-col items-center">
                <!-- Gambar Profil -->
                <form action="{{ route('profile.uploadPicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label class="cursor-pointer relative">
                        <img src="{{ asset(auth()->user()->picture ?? 'default-user.png') }}"
                             class="w-32 h-32 rounded-full border-2 border-gray-300 object-cover"
                             alt="Profile Picture">
                        <input type="file" name="picture" class="hidden" onchange="this.form.submit()">
                        <span class="absolute bottom-0 right-0 bg-white rounded-full p-1 text-xs shadow">Edit</span>
                    </label>
                </form>

                <!-- Menu -->
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

    <!-- ISI HALAMAN -->
     <div class="flex-1 min-h-screen bg-gray-50 p-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl w-full mx-auto mb-10">

        {{-- Tabs --}}
        <div class="flex gap-6 border-b border-gray-300 mb-6">
    <a href="{{ route('profile.rentalInfo') }}"
       class="pb-2 font-semibold {{ request()->routeIs('profile.rentalInfo') ? 'text-purple-800 border-b-2 border-gray-800' : 'text-gray-500 hover:text-gray-800' }}">
        Rent List
    </a>
    
    <a href="{{ route('profile.rentalHistory') }}"
       class="pb-2 font-semibold {{ request()->routeIs('profile.rentalHistory') ? 'text-purple-800 border-b-2 border-gray-800' : 'text-gray-500 hover:text-purple-800' }}">
        Rental History
    </a>
</div>


        {{-- Section per Toko --}}
        @for ($toko = 1; $toko <= 2; $toko++)
        <div class="mb-8">
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Nama Toko yang produknya di sewa</h3>

            {{-- Daftar Produk --}}
            <div class="space-y-4">
                @for ($i = 0; $i < 2; $i++)
                <div class="flex items-start gap-4">
                    {{-- Gambar --}}
                    <div class="bg-gray-300 text-white text-xs font-bold w-24 h-24 flex items-center justify-center rounded">
                        GAMBAR<br>SEWAAN
                    </div>

                    {{-- Detail --}}
                    <div class="flex-1 text-sm text-gray-700">
                        <p class="font-medium">Light Stick</p>
                        <p>Ver 2</p>
                        <p class="text-xs text-gray-500 mt-2">IDR 100.000</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>
        @endfor
    </div> 
</div>
</x-app-layout>