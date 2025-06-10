<x-app-layout>
    <div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
    <!-- SIDEBAR -->
    <x-sidebar-profile :user="auth()->user()" />

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