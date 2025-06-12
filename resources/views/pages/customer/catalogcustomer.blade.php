@extends('layouts.catalog')

@section('title', 'Catalog Customer')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    @include('components.filtercatalog')

    <!-- Product Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1">
        @foreach($products as $product)
            <x-productgridcatalog :product="$product" />
        @endforeach
    </section>
</div>
@endsection