@extends('layouts.app')

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
    <a href="{{ route('contact') }}"
        class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Contact
    </a>
    <a href="{{ route('profile.edit') }}"
         class="{{ request()->routeIs('profile.*') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
         Profile
    </a>
</div>
@endsection

@section('content')
<!-- CONTAINER UTAMA -->
<div class=" flex flex-col md:flex-row bg-gray-50 min-h-[80vh]">
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
    
    @foreach ($rentalList as $rental)
      @foreach ($rental->rentalItems as $item)
        {{-- Informasi Produk --}}
        <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
            <div class="flex justify-between items-center mb-2">
                <h4 class="font-semibold text-lg text-purple-800">{{ $item->product->name }}</h4>
                <span class="text-xs text-gray-500">{{ $item->product->category->name ?? '' }}</span>
            </div>
            <p class="text-sm text-gray-600 mb-2">
                Durasi Sewa: {{ $item->rental_days }} hari<br>
                Harga Sewa: Rp{{ number_format($item->price, 0, ',', '.') }}
            </p>

            {{-- Jika status Completed dan belum di-review --}}
            @if($rental->status === 'Completed' && !$item->review)
                <div class="mt-4">
                    <x-add-review :rentalItem="$item" />
                </div>
            @elseif($item->review)
                <p class="text-green-600 text-sm font-medium mt-2">✅ Review submitted</p>
            @endif
        </div>
      @endforeach
    @endforeach

</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
