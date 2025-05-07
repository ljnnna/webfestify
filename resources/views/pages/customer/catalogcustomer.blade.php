@extends('layouts.main')

@section('title', 'Catalog Customer')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    @include('components.filter-sidebar')

    <!-- Product Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1">
        @for ($i = 0; $i < 6; $i++)
        <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
            <img src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg" alt="Lightstick Seventeen"
                 class="rounded-xl mb-4 w-full max-w-[250px] object-cover">
            <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">Lightstick Seventeen</h3>
            <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
            <a href="{{ url('details_product_catalog_customer') }}"
               class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                Details
            </a>
        </article>
        @endfor
    </section>
</div>
@endsection
