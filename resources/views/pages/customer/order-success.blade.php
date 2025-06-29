@extends('layouts.payment')

@section('desktop-menu')
<div class="hidden lg:flex space-x-6 -ml-6">
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
<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <!-- Success Icon -->
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check text-3xl text-green-600"></i>
            </div>
            
            <!-- Success Message -->
            <h1 class="text-3xl font-bold text-gray-800 mb-4">Payment Successful!</h1>
            <p class="text-gray-600 mb-8">Thank you for your payment. Your order has been confirmed.</p>
            
            <!-- Order Details -->
            <div class="bg-gray-50 rounded-lg p-6 mb-8 text-left">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Order Details</h3>
                <div class="space-y-2">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Order ID:</span>
                        <span class="font-medium">{{ $order->order_code }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total Amount:</span>
                        <span class="font-medium">Rp. {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Status:</span>
                        <span class="font-medium text-green-600">{{ ucfirst($order->status) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Rental Period:</span>
                        <span class="font-medium">{{ $order->start_date }} to {{ $order->end_date }}</span>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('home') }}" 
                   class="flex-1 bg-gradient-to-r from-[#B6B0F7] to-[#F9D9FF] text-[#5B4B7A] font-semibold py-3 px-6 rounded-full hover:brightness-105 transition-all duration-200">
                    Back to Home
                </a>
                <a href="{{ route('profile.rentalInfo') }}" 
                   class="flex-1 border-2 border-[#B6B0F7] text-[#5B4B7A] font-semibold py-3 px-6 rounded-full hover:bg-[#F9D9FF] transition-all duration-200">
                    View Order
                </a>
            </div>
        </div>
    </div>
</div>
@endsection