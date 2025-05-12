@extends('layouts.payment')

@section('title', 'Payment Customer')

@section('body-class', 'bg-gradient-to-b from-[#F9D9FF] to-[#D9D9FF]
min-h-screen') 

@push('styles')

<style>
    .cancel-button {
        background: linear-gradient(to right, #b6b0f7, #f9d9ff);
    }
</style>

@endpush 

@section('content')
<div class="flex items-center justify-center p-8">
    <main
        class="max-w-6xl w-full bg-white/90 rounded-xl shadow-md p-10 grid grid-cols-1 md:grid-cols-2 gap-10"
    >
        <!-- Left side -->
        <section>
            <h1
                class="text-[36px] font-extrabold text-[#5B4B7A] mb-6 border-b border-gray-300 pb-2"
            >
                ORDER DETAILS
            </h1>
            @include('components.ordersummary')

            <div class="mt-8 flex justify-center">
                <button
                    class="max-w-xs w-full ml-[-65px] py-3 text-[#5B4B7A] font-extrabold text-lg rounded-full bg-gradient-to-r from-[#B6B0F7] to-[#F9D9FF] shadow-md hover:brightness-105 transition"
                    type="button"
                >
                    CANCEL ORDER
                </button>
            </div>
        </section>

        <!-- Right side -->
        <section class="flex flex-col justify-between">
            @include('components.orderform')
        </section>
    </main>
</div>