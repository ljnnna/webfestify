@extends('layouts.search')

@section('title', 'Search Customer')

@section('content')
<!-- Filter Drawer (tersembunyi, muncul ketika diklik) -->
@include('components.filtersidebar')

<!-- Main Content Area -->
<div class="w-full">
    <!-- Header dengan jumlah hasil -->
    <div class="mb-6">
        <h1 class="text-[#34006C] font-semibold text-xl mb-1">Search Results</h1>
        <p class="text-[#493862] text-sm">6 products found</p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @include('components.productgridsearch')
    </div>
</div>
@endsection