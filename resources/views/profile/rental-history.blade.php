@extends('layouts.app')

{{-- Desktop Menu --}}
{{-- Desktop Menu --}}
@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Home
    </a>
    <a href="{{ route('catalog') }}"
        class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Catalog
    </a>
    <a href="{{ route('team') }}"
        class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Team
    </a>
    <a href="{{ route('details') }}"
        class="{{ request()->routeIs('details') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Contact
    </a>
    <a href="{{ route('profile.edit') }}"
         class="{{ request()->routeIs('profile.*') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
         Profile
    </a>
</div>
@endsection

@section('content')
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
                {{ request()->routeIs('profile.rentalInfo') || request()->routeIs('profile.rentalHistory') ? 'bg-white text-purple-800 font-bold' : 'hover:bg-purple-100' }}">
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

            {{-- Kartu Isi --}}
            <div class="bg-white shadow rounded-lg p-6 flex flex-col md:flex-row gap-6">
                {{-- Gambar --}}
                <div class="bg-gray-300 text-white text-lg font-bold w-40 h-40 flex items-center justify-center rounded">
                    GAMBAR<br>SEWAAN
                </div>

                {{-- Informasi Produk & Riwayat --}}
                <div class="flex-1 text-sm text-gray-700">
                    <p class="text-red-600 font-semibold mb-1">Informasi Produk:</p>
                    <p class="mb-4">Iphone &nbsp; <strong>16 Pro</strong></p>

                    <p class="text-red-600 font-semibold mb-1">Riwayat Pemesanan:</p>
                    <ul class="list-disc list-inside mb-6">
                        <li>Pesanan Masih Dalam Sewaan</li>
                        <li>Pesanan Telah selesai.</li>
                    </ul>

                    <a href="#" class="text-red-500 font-medium hover:underline text-sm">Lihat Konfirmasi Pengembalian</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
