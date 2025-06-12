@extends('layouts.app')

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
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
