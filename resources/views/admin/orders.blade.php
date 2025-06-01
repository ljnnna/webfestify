@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Order Overview</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Produk -->
        <x-card-stat title="Total Orders" :value="0" />

        <!-- Order Baru -->
        <x-card-stat title="Completed" :value="0" />

        <!-- On Progress -->
        <x-card-stat title="On Progress" :value="0" />

        <!-- Order Selesai -->
        <x-card-stat title="Canceled" :value="0" />
        
    </div>
    <div class="mt-10 overflow-x-auto">
    <table class="w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
        <thead class="text-xs text-white uppercase bg-[#d3b9f6]">
            <tr>
                <th class="px-6 py-3">Username</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Price</th>
                <th class="px-6 py-3">Order Date</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($orders as $order)
                <tr class="border-t border-gray-200">
                    <td class="px-6 py-4">{{ $order->username }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded
                            @if($order->status === 'Completed')
                                bg-green-100 text-green-800
                            @elseif($order->status === 'Pending')
                                bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'Canceled')
                                bg-red-100 text-red-800
                            @endif
                        ">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">Rp{{ number_format($order->price, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                                                                                           


@endsection                                                                                                                                                                                                                                                                                                                                                                                                                            