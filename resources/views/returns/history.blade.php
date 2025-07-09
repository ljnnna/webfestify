@extends('layouts.app')

@section('title', 'Return History')

@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Home</a>
    <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Catalog</a>
    <a href="{{ route('team') }}" class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Team</a>
    <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Contact</a>
    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">Profile</a>
</div>
@endsection

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-center text-[#493862]">
        Return History for {{ $orderProduct->product->name }}
    </h2>

    @if ($return)
    <div class="bg-white shadow-xl rounded-xl p-6 space-y-6">
        {{-- PRODUCT DETAILS --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 flex flex-col md:flex-row gap-6">
            {{-- Product Image --}}
            <div class="w-full md:w-40 shrink-0">
                <img src="{{ $orderProduct->product->images->first()
                            ? asset('storage/' . $orderProduct->product->images->first()->path)
                            : asset('images/placeholder.jpg') }}"
                    alt="{{ $orderProduct->product->name }}"
                    class="rounded-lg w-full h-auto object-cover border">
            </div>

            {{-- Product + Customer Info --}}
            <div class="flex-1 space-y-2 text-sm text-gray-700">
                <p><strong>Product:</strong> {{ $orderProduct->product->name }}</p>
                <p><strong>Price:</strong> Rp {{ number_format($orderProduct->product->price, 0, ',', '.') }}</p>

                @if($orderProduct->product->details)
                <div>
                    <strong>Details:</strong>
                    <ul class="list-disc list-inside mt-1">
                        @foreach(explode(',', $orderProduct->product->details) as $detail)
                            <li>{{ trim($detail) }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <hr class="my-2">

                <p><strong>Customer:</strong> {{ $order->user->name }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone_number ?? '-' }}</p>
                <p><strong>Address:</strong> {{ $order->user->address ?? '-' }}</p>
                <p><strong>Order Code:</strong> {{ $order->order_code }}</p>
            </div>
        </div>

        {{-- RETURN DETAILS --}}
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
            <h3 class="text-lg font-semibold text-indigo-700 mb-4">Return Details</h3>
            <table class="table-auto w-full text-sm text-left text-gray-700">
                <tbody>
                    <tr class="border-b">
                        <th class="py-2 pr-4 text-gray-600 w-1/3">Status</th>
                        <td class="py-2">{{ ucfirst($return->return_status) }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 pr-4 text-gray-600">Return Method</th>
                        <td class="py-2">{{ ucfirst($return->return_method ?? '-') }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 pr-4 text-gray-600">Completed At</th>
                        <td class="py-2">
                            {{ $return->return_completed_at
                                ? \Carbon\Carbon::parse($return->return_completed_at)->format('d M Y')
                                : '-' }}
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 pr-4 text-gray-600">Condition Notes (Admin)</th>
                        <td class="py-2">{{ $return->condition_notes ?? '-' }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="py-2 pr-4 text-gray-600">Product Condition</th>
                        <td class="py-2">{{ ucfirst($return->product_condition ?? '-') }}</td>
                    </tr>
                    <tr>
                        <th class="py-2 pr-4 text-gray-600">Penalty Amount</th>
                        <td class="py-2">
                            @if ($return->penalty_amount > 0)
                                Rp {{ number_format($return->penalty_amount, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- CONDITION PHOTOS --}}
        <div>
            <h3 class="text-sm font-semibold mb-2 text-gray-700">Condition Before:</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach (json_decode($return->condition_before ?? '[]') as $photo)
                    <img src="{{ asset('storage/conditions/' . $photo) }}"
                         class="rounded-lg border shadow object-cover w-full h-28">
                @endforeach
            </div>
        </div>

        <div>
            <h3 class="text-sm font-semibold mb-2 text-gray-700">Condition After:</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @foreach (json_decode($return->condition_after ?? '[]') as $photo)
                    <img src="{{ asset('storage/conditions/' . $photo) }}"
                         class="rounded-lg border shadow object-cover w-full h-28">
                @endforeach
            </div>
        </div>

        {{-- Back to Home Button --}}
        <div class="pt-6 text-center">
            <a href="{{ route('home') }}"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow text-sm inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 12l6-6m-6 6l6 6"></path>
                </svg>
                Back to Home
            </a>
        </div>
    </div>
    @else
    <div class="bg-white p-6 rounded shadow text-center text-gray-600">
        No return history found for this item.
    </div>
    @endif
</div>
@endsection
