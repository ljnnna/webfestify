@extends('layouts.admin')

@section('title', 'User')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Customer Overview</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Produk -->
        <x-card-stat title="User" :value="739" />

        <!-- Order Baru -->
        <x-card-stat title="Active User" :value="426" />

        <!-- On Progress -->
        <x-card-stat title="New Signups" :value="80" />

        <!-- Order Selesai -->
        <x-card-stat title="Feedback Received" :value="209" />
        
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
        
        
@endsection
