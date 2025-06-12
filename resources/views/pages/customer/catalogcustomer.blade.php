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
<div class="w-full bg-white px-4 py-4 rounded-lg mt-6 mb-4">
    <section class="grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-6 gap-4 flex-1">
        @include('components.productgridcatalog')
    </section>
</div>

@endsection