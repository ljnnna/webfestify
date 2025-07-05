@extends('layouts.app')

@section('title', 'Profile')

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
<div class="flex flex-col md:flex-row min-h-screen bg-gray-50">
    <!-- SIDEBAR -->
    <x-sidebar-profile :user="auth()->user()" />


    <!-- ISI HALAMAN -->
    <div class="flex-1 h-screen overflow-y-auto bg-gray-50 p-6">
        <div class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl w-full mx-auto mb-10">

            {{-- Tabs --}}
        @php
            $status = request('status');
        @endphp
        <div class="overflow-x-auto">
            <div class="flex justify-center mb-6 min-w-max">
                <div class="flex space-x-14 border-b border-gray-300 whitespace-nowrap px-4">
                    @foreach ([
                        '' => 'All',
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',  
                        'active' => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled'
                    ] as $key => $label)
                        @php
                            $isActive = $status === $key || ($key === '' && $status === null);
                        @endphp
                        <a href="{{ route('profile.rentalInfo', ['status' => $key]) }}"
                           class="pb-3 border-b-2 transition-all duration-200 {{ $isActive ? 'text-pink-600 border-purple-600 font-medium' : 'text-gray-800 border-transparent hover:text-pink-500' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
                    

         {{-- Section per orders --}}
@foreach ($activeOrders as $order)
@php
    $product = $order->products->first();

    // Logic override status berdasarkan payment_status
    if ($order->payment_status === 'unpaid') {
        $adjustedStatus = 'pending';
    } elseif ($order->payment_status === 'paid') {
        $adjustedStatus = 'confirmed';
    } else {
        $adjustedStatus = $order->status;
    }

    $diffInHours = now()->diffInHours($order->end_date, false);
    $daysLeft = (int) ceil($diffInHours / 24);

    // Warna border & background berdasarkan status baru
    if ($adjustedStatus === 'pending') {
        $borderColor = 'border-gray-400';
        $bgColor = 'bg-white';
    } elseif ($adjustedStatus === 'active') {
        if ($daysLeft < 0) {
            $borderColor = 'border-red-600';
            $bgColor = 'bg-red-50';
        } elseif ($daysLeft === 0) {
            $borderColor = 'border-red-500';
            $bgColor = 'bg-white';
        } elseif ($daysLeft === 1) {
            $borderColor = 'border-yellow-400';
            $bgColor = 'bg-white';
        } else {
            $borderColor = 'border-purple-400';
            $bgColor = 'bg-white';
        }
    } else {
        $borderColor = 'border-gray-300';
        $bgColor = 'bg-white';
    }
@endphp

@php
    $product = $order->products->first();
    $diffInHours = now()->diffInHours($order->end_date, false);
    $daysLeft = (int) ceil($diffInHours / 24);

    // Tentukan warna border dan background sesuai kondisi
    if ($order->status === 'pending') {
        $borderColor = 'border-gray-400';
        $bgColor = 'bg-white';
    } elseif ($order->status === 'active') {
        if ($daysLeft < 0) {
            $borderColor = 'border-red-600';
            $bgColor = 'bg-red-50'; // overdue
        } elseif ($daysLeft === 0) {
            $borderColor = 'border-red-500';
            $bgColor = 'bg-white'; // harus balikin hari ini
        } elseif ($daysLeft === 1) {
            $borderColor = 'border-yellow-400';
            $bgColor = 'bg-white';
        } else {
            $borderColor = 'border-purple-400';
            $bgColor = 'bg-white';
        }
    } else {
        $borderColor = 'border-gray-300';
        $bgColor = 'bg-white';
    }
@endphp

<div class="mt-4 {{ $bgColor }} rounded-lg shadow-md border-l-4 {{ $borderColor }} flex p-4 space-x-4 relative">
                <img src="{{ $product && $product->image ? asset('storage/' . $product->image) : asset('images/no-image.jpg') }}"
                         alt="{{ $product?->name ?? 'No product' }}"
                         class="w-28 h-28 object-cover rounded">

                <div class="flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-semibold text-gray-900 text-base leading-tight">
                            Order #{{ $order->order_code ?? $order->id }}
                        </h3>
                        <div class="mt-2 text-gray-600 text-sm space-y-1">
                <div class="flex items-center space-x-2">
                    @if ($adjustedStatus !== 'active')
                        <!-- Tampilkan rentang tanggal sewa jika statusnya bukan 'active' -->
                        <i class="far fa-calendar-alt text-gray-400"></i>
                        <span class="text-gray-600">
                            Time: {{ $order->start_date->format('d M Y') }} - {{ $order->end_date->format('d M Y') }}
                        </span>
                    @else
                        @php
                            $diffInHours = now()->diffInHours($order->end_date, false);
                            $daysLeft = (int) ceil($diffInHours / 24);
                        @endphp
                                    
                        <!-- Tampilkan countdown jika statusnya 'active' -->
                        <i class="far fa-clock {{ 
                            $daysLeft === 0 ? 'text-red-600' : 
                            ($daysLeft < 0 ? 'text-red-600' : 
                            ($daysLeft === 1 ? 'text-orange-500' : 'text-gray-400')) 
                        }}"></i>
                                    
                        <span class="{{ 
                            $daysLeft === 0 ? 'text-red-600 font-semibold' : 
                            ($daysLeft < 0 ? 'text-red-600 font-bold' : 
                            ($daysLeft === 1 ? 'text-orange-500 font-semibold' : 'text-gray-600')) 
                        }}">
                            {{ $daysLeft > 1 
                                ? $daysLeft . ' days left' 
                                : ($daysLeft === 1 
                                    ? '1 day left' 
                                    : ($daysLeft === 0 
                                        ? 'Need to Return' 
                                        : 'Overdue')) }}
                        </span>
                    @endif
                </div>

                            <div class="flex items-center space-x-2">
                                <i class="fas fa-map-marker-alt text-gray-400"></i>
                                <span>
                                    Method: 
                                    <span class="capitalize">
                                        {{ $order->delivery_option ?? 'N/A' }}
                                    </span>
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-money-bill-wave text-gray-400"></i>
                                <span>
                                    Total Cost: <strong>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-3 mt-4 justify-end">
                    <a href="{{ route('profile.rentalDetail', ['order' => $order->id]) }}"
                       class="text-white text-xs px-4 py-1 rounded bg-gradient-to-r from-indigo-300 to-purple-400 hover:from-indigo-500 hover:to-purple-600">
                       View Detail
                    </a>
                    @if (in_array($adjustedStatus, ['pending', 'confirmed']))
                    <form action="{{ route('order.cancel', ['order' => $order->id]) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to cancel this order?')">
                        @csrf
                        <button type="submit"
                                class="text-white text-xs px-4 py-1 rounded bg-red-400 hover:bg-red-600">
                            Cancel
                        </button>
                    </form>
                    @endif
                    </div>
                </div>
                <span class="absolute top-4 right-4 bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                    {{ ucfirst($adjustedStatus) }}

                </span>
            </div>
         @endforeach     
        </div> 
    </div>
</div>
@endsection