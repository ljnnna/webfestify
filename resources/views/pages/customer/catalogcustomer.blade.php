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

        <a href="{{ route('details') }}"
            class="{{ request()->routeIs('details') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
              Contact
        </a>
    </div>

<script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    @include('components.filtercatalog')

    <!-- Product Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1">
        @include('components.productgridcatalog')
    </section>
</div>
@endsection