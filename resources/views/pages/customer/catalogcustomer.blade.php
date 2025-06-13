@extends('layouts.catalog')

@section('title', 'Catalog Customer')

@section('content')

<div class="flex flex-col md:flex-row gap-8 mb-6 items-start">
    <!-- Filter Kiri -->
    <div class="md:w-[52%]">
        @include('components.filtercatalog')
    </div>

    <!-- Kategori Kanan -->
    <div class="md:w-[48%]">
        @include('components.category-card')
    </div>
</div>

@include('components.images-layout')

<!-- Product Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1">
        @foreach($products as $product)
            <x-productgridcatalog :product="$product" />
        @endforeach
    </section>

@endsection