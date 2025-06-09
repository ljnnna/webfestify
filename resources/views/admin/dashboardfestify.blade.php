@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Website Performance</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Produk -->
        <x-card-stat title="All Product" :value="$total_product" />

        <!-- Order Baru -->
        <x-card-stat title="New Order" :value="$order_new ?? 0" />

        <!-- On Progress -->
        <x-card-stat title="On Progress" :value="$order_progress ?? 0" />

        <!-- Order Selesai -->
        <x-card-stat title="Order Done" :value="$order_done ?? 0" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        <!-- Produk Tersedia -->
        <x-card-stat title="Product Available" :value="$product_available ?? 0" />

        <!-- Produk Disewa -->
        <x-card-stat title="Product Rented" :value="$product_rented ?? 0" />

        <!-- Customer -->
        <x-card-stat title="User" :value="$total_customers" />
    </div>
@endsection
