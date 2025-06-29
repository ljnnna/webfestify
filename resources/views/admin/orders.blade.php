@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Order Overview</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Order -->
        <x-card-stat title="Total Orders" :value="$totalOrders ?? 0" />

        <!-- Order Selesai -->
        <x-card-stat title="Completed" :value="$completedOrders ?? 0" />

        <!-- On Progress -->
        <x-card-stat title="On Progress" :value="$onProgressOrders ?? 0" />

        <!-- Order Dibatalkan -->
        <x-card-stat title="Canceled" :value="$canceledOrders ?? 0" />
        
    </div>
    <div class="mt-10 overflow-x-auto">
    <table class="w-full text-sm text-center text-gray-700 border border-gray-200 rounded-lg">
        <thead class="text-xs text-white uppercase bg-[#d3b9f6]">
            <tr>
                <th class="px-6 py-3">Order Code</th>
                <th class="px-6 py-3">Name</th>
                <th class="px-6 py-3">Total Amount</th>
                <th class="px-6 py-3">Order Date</th>
                <th class="px-6 py-3">Payment Status</th>
                <th class="px-6 py-3">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($orders as $order)
                <tr class="border-t border-gray-200">
                    <td class="px-6 py-4">{{ $order->order_code }}</td>
                    <td class="px-6 py-4">{{ $order->user->name ?? 'Tidak ditemukan' }}</td>
                    <td class="px-6 py-4">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}</td>
                    <td class="px-6 py-4">
                        @php
                            $bgColor = match($order->status) {
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'confirmed' => 'bg-blue-100 text-blue-800',
                                'active' => 'bg-green-100 text-green-800',
                                'completed' => 'bg-gray-100 text-gray-800',
                                'cancelled' => 'bg-red-100 text-red-800',
                                default => 'bg-gray-100 text-gray-800',
                            };
                        @endphp
                        <span class="px-2 py-1 text-xs font-medium rounded {{ $bgColor }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="border px-2 py-1 rounded bg-white shadow text-sm">
                                @foreach (['pending', 'confirmed', 'active', 'completed', 'cancelled'] as $status)
                                    <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                                                                                           


@endsection                                                                                                                                                                                                                                                                                                                                                                                                                            