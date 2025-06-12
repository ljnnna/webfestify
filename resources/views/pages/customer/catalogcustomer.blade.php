@extends('layouts.catalog')

@section('title', 'Catalog Customer')

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
</div>

@endsection

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