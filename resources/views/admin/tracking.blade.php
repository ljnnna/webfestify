@extends('layouts.admin')

@section('title', 'Tracking Product')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6 text-[#493862]">Order Delivery Tracking</h2>

    @foreach ($orders as $order)
    <div class="bg-white border border-gray-200 rounded-2xl p-6 mb-8 shadow-md">
        <div class="mb-4">
            <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
            <p><strong>Delivery Method:</strong> {{ ucfirst($order->delivery_option) }}</p>
            <p><strong>Status:</strong> 
                <span class="text-yellow-600 font-semibold">
                    {{ ucwords(str_replace('_', ' ', $order->delivery_status)) }}
                </span>
            </p>
        </div>

        {{-- FORM UPDATE STATUS (Hanya untuk delivery) --}}
        @if($order->delivery_option === 'delivery')
        <form action="{{ route('admin.update.delivery.status', $order->id) }}" method="POST" class="mb-4">
            @csrf
            @method('PUT')
            <label for="delivery_status_{{ $order->id }}" class="block font-medium mb-2">Update Status:</label>
            <div class="flex items-center gap-3">
                <select name="delivery_status" id="delivery_status_{{ $order->id }}" class="rounded-lg border-gray-300">
                    <option value="confirmed" {{ $order->delivery_status === 'confirmed' ? 'selected' : '' }}>Order Confirmed</option>
                    <option value="preparing" {{ $order->delivery_status === 'preparing' ? 'selected' : '' }}>Preparing Items</option>
                    <option value="ready_to_ship" {{ $order->delivery_status === 'ready_to_ship' ? 'selected' : '' }}>Ready to Ship</option>
                    <option value="in_delivery" {{ $order->delivery_status === 'in_delivery' ? 'selected' : '' }}>In Delivery</option>
                    <option value="delivered" {{ $order->delivery_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition">
                    Update
                </button>
            </div>
        </form>
        @endif

        {{-- TRACKING STEPS (Delivery Only) --}}
        @if($order->delivery_option === 'delivery')
        @php
            $steps = [
                'confirmed'     => 'Order Confirmed',
                'preparing'     => 'Preparing Items',
                'ready_to_ship' => 'Ready to Ship',
                'in_delivery'   => 'In Delivery',
                'delivered'     => 'Delivered',
            ];
            $statuses = array_keys($steps);
            $currentStepIndex = array_search($order->delivery_status, $statuses);
            if ($currentStepIndex === false) $currentStepIndex = 0;
        @endphp

        <div class="flex items-center justify-between relative mt-8">
            {{-- Progress bar --}}
            <div class="absolute top-5 left-0 right-0 h-1 bg-gray-200 z-0 rounded-full"></div>
            <div class="absolute top-5 left-0 z-10 h-1 bg-purple-500 rounded-full transition-all duration-500" style="width: {{ (($currentStepIndex + 1) / count($steps)) * 100 }}%"></div>

            @foreach ($steps as $key => $label)
                @php
                    $stepIndex = array_search($key, $statuses);
                    $completed = $stepIndex < $currentStepIndex;
                    $active = $stepIndex === $currentStepIndex;
                @endphp
                <div class="flex flex-col items-center z-20 w-1/5">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center mb-2
                        {{ $completed ? 'bg-purple-500 text-white' : ($active ? 'bg-purple-200 text-purple-700' : 'bg-gray-300 text-gray-600') }}">
                        {{ $stepIndex + 1 }}
                    </div>
                    <p class="text-sm font-semibold text-center {{ $active ? 'text-purple-700' : 'text-gray-600' }}">
                        {{ $label }}
                    </p>
                    <p class="text-xs text-gray-500 text-center">
                        @switch($key)
                            @case('confirmed') Your order has been received. @break
                            @case('preparing') Admin is preparing your items. @break
                            @case('ready_to_ship') Items are ready to be shipped. @break
                            @case('in_delivery') Items are on the way. @break
                            @case('delivered') Delivery completed. @break
                        @endswitch
                    </p>
                </div>
            @endforeach
        </div>
        @endif

        {{-- CARD KHUSUS PICKUP --}}
        @if($order->delivery_option === 'pickup')
        <div class="mt-6 bg-blue-50 border border-blue-200 p-4 rounded-xl">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">Pickup Confirmation</h3>
            @if($order->pickup_confirmed_at)
                <p class="text-sm text-gray-800 mb-1"><strong>Confirmed At:</strong>
                    {{ \Carbon\Carbon::parse($order->pickup_confirmed_at)->format('d M Y H:i') }}
                </p>

                @php
                    $expired = \Carbon\Carbon::parse($order->pickup_confirmed_at)->addHours(5);
                    $now = now();
                    $statusText = $now->gt($expired)
                        ? '❌ Pickup time expired'
                        : '✅ Still within pickup window';
                @endphp

                <p class="text-sm {{ $now->gt($expired) ? 'text-red-600' : 'text-green-600' }}">
                    {{ $statusText }} (until {{ $expired->format('H:i') }})
                </p>
            @else
                <p class="text-sm text-gray-500">Customer has not confirmed pickup yet.</p>
            @endif
        </div>
        @endif
    </div>
    @endforeach
</div>
@endsection
