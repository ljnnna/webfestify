@extends('layouts.search')

@section('title', 'Search Customer')

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
<!-- Filter Drawer (tersembunyi, muncul ketika diklik) -->
@include('components.filtersidebar')

<!-- Main Content Area -->
<div class="w-full">
    <!-- Header dengan jumlah hasil -->
    <div class="mb-6">
        <h1 class="text-[#34006C] font-semibold text-xl mb-1">Search Results</h1>
        <p class="text-[#493862] text-sm">{{ $products->count() }} products found</p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @include('components.product-search')
    </div>
</div>
@endsection