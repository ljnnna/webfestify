@extends('layout.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Selamat Datang Nania sebagai Administrator</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Produk -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-blue-700 font-semibold uppercase mb-1">Produk</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $total_product }}</h2>
                </div>
                <div class="text-blue-400 text-3xl">🏕️</div>
            </div>
        </div>

        <!-- Transaksi -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-green-700 font-semibold uppercase mb-1">Transaksi</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $total_sewa }}</h2>
                </div>
                <div class="text-green-400 text-3xl">💸</div>
            </div>
        </div>

        <!-- Customer -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-cyan-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-cyan-700 font-semibold uppercase mb-1">Customer</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $total_customers }}</h2>
                </div>
                <div class="text-cyan-400 text-3xl">👥</div>
            </div>
        </div>

        <!-- Laporan -->
        <div class="bg-white p-4 rounded-xl shadow border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-yellow-700 font-semibold uppercase mb-1">Laporan</p>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $total_reports }}</h2>
                </div>
                <div class="text-yellow-400 text-3xl">📄</div>
            </div>
        </div>
    </div>
@endsection
