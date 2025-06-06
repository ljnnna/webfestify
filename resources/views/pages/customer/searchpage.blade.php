@extends('layouts.catalog')

@section('title', 'Search Customer')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    @include('components.filtersidebar')

    <!-- Product Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1">
        @include('components.productgridsearch')
    </section>
</div>
@endsection