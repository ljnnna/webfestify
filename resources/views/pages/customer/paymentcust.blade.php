@extends('layouts.payment')

@section('title', 'Payment Customer - Festify')

@section('body-class', 'bg-gradient-to-b from-[#F9D9FF] to-[#D9D9FF] min-h-screen')

@section('content')
<!-- Include Navbar -->
@include('components.navbar')

<!-- Ubah pt-24 menjadi pt-4 atau pt-6 untuk mengurangi jarak -->
<main class="pt-4 container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white/90 rounded-xl shadow-lg p-6 sm:p-8 lg:p-10 backdrop-blur-sm">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 lg:items-stretch">

                <div class="flex flex-col">
                    @include('components.orderdetailssection')
                </div>
                
                <div class="flex flex-col">
                    @include('components.paymentsection')
                </div>

            </div>
        </div>
    </div>
</main>
@endsection