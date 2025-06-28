@extends('layouts.payment')

@section('title', 'Payment Customer - Festify')

@section('body-class', 'bg-gradient-to-b from-[#F9D9FF] to-[#D9D9FF] min-h-screen')

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

@php
    $isRentNow = isset($paymentData['rental_data']) && isset($paymentData['product']);

    if ($isRentNow) {
        $rental = $paymentData['rental_data'];
        $product = $paymentData['product'];

        $items = collect([(object)[
            'product' => $product,
            'quantity' => $rental['quantity'],
            'delivery_option' => $rental['delivery_option'],
            'recipient_name' => $rental['recipient_name'] ?? '-',
            'phone_number' => $rental['phone_number'] ?? '-',
            'delivery_address' => $rental['delivery_address'] ?? '-',
            'rental_days' => $rental['rental_days'],
        ]]);

        $pricing = $paymentData['pricing'] ?? [
            'subtotal' => 0,
            'service_fee' => 0,
            'deposit' => 0,
            'delivery_fee' => 0,
            'total' => 0,
        ];
    } else {
        $cartItems = $paymentData['cart_items'] ?? collect();
        $items = $cartItems; // ✅ ini yang sangat penting
        $pricing = $paymentData['pricing'] ?? [
            'subtotal' => 0,
            'service_fee' => 0,
            'deposit' => 0,
            'delivery_fee' => 0,
            'total' => 0,
        ];
    }
@endphp



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

@if($items->isEmpty())
    <p class="text-red-500">No items to display (empty cart or data issue)</p>
@endif

@endsection
