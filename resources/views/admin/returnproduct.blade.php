@extends('layouts.admin')

@section('title', 'Return Product')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-[#493862]">Returned Product</h1>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-4">
        <!-- Product Rented -->
        <x-card-stat title="Product Rented" :value="$productRented" />

        <!-- Product Returned -->
        <x-card-stat title="Product Returned" :value="$productReturned" />
        
    </div>

    <!-- Tab Navigation -->
    <div class="mt-10 mb-6">
        <nav class="flex space-x-4">
            <button onclick="showTab('active-orders')" id="tab-active-orders" class="px-4 py-2 bg-[#d3b9f6] text-white rounded font-semibold">
                Orders Aktif ({{ count($activeOrders) }})
            </button>
            <button onclick="showTab('returns')" id="tab-returns" class="px-4 py-2 bg-gray-200 text-gray-700 rounded font-semibold">
                Return Process ({{ count($returns) }})
            </button>
        </nav>
    </div>

    <!-- Active Orders Tab -->
    <div id="active-orders-tab" class="overflow-x-auto">
        <h3 class="text-lg font-semibold mb-4 text-[#493862]">Orders Sedang Disewa - Menunggu Return</h3>
        <table class="w-full text-sm text-center text-gray-700 border border-gray-200 rounded-lg">
            <thead class="text-xs text-white uppercase bg-[#d3b9f6]">
                <tr>
                    <th class="px-6 py-3">Order Code</th>
                    <th class="px-6 py-3">Customer</th>
                    <th class="px-6 py-3">Products</th>
                    <th class="px-6 py-3">Rental Period</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($activeOrders as $order)
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-4">{{ $order->order_code }}</td>
                        <td class="px-6 py-4">{{ $order->user->name ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            @foreach($order->orderProducts as $orderProduct)
                                <div class="text-sm">
                                    {{ $orderProduct->product->name ?? 'N/A' }} ({{ $orderProduct->quantity }}x)
                                </div>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($order->start_date)->format('d/m/Y') }} - 
                            {{ \Carbon\Carbon::parse($order->end_date)->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs font-medium rounded bg-green-100 text-green-800">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.returns.createReturn', $order->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-600">
                                    Mulai Return
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if(count($activeOrders) === 0)
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-gray-500 text-center">
                            Tidak ada orders aktif yang menunggu return
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Returns Tab -->
    <div id="returns-tab" class="overflow-x-auto" style="display: none;">
        <h3 class="text-lg font-semibold mb-4 text-[#493862]">Process Return - Upload Kondisi & Konfirmasi</h3>
        <table class="w-full text-sm text-center text-gray-700 border border-gray-200 rounded-lg">
            <thead class="text-xs text-white uppercase bg-[#d3b9f6]">
                <tr>
                    <th class="px-6 py-3">Order Code</th>
                    <th class="px-6 py-3">Product</th>
                    <th class="px-6 py-3">Qty</th>
                    <th class="px-6 py-3">Rental Period</th>
                    <th class="px-6 py-3">Returned Status</th>
                    <th class="px-6 py-3">Product Cond</th>
                    <th class="px-6 py-3">Cond Before</th>
                    <th class="px-6 py-3">Cond After</th>
                    <th class="px-6 py-3">Upload Cond</th>
                    <th class="px-6 py-3">Cond Notes</th>
                    <th class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($returns as $return)
                    <tr class="border-t border-gray-200">
                        <td class="px-6 py-4">{{ $return->order->order_code ?? 'N/A' }}</td>
                        <td class="px-6 py-4">{{ $return->product->name ?? 'Tidak ditemukan' }}</td>
                        <td class="px-6 py-4">{{ $return->quantity_returned }}</td>
                        <td class="px-6 py-4">
                            @if($return->order)
                                {{ \Carbon\Carbon::parse($return->order->start_date)->format('d/m/Y') }} - 
                                {{ \Carbon\Carbon::parse($return->order->end_date)->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $bgColor = match($return->return_status) {
                                    'in_process' => 'bg-yellow-100 text-yellow-800',
                                    'completed' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    default => 'bg-gray-100 text-gray-800',
                                };
                            @endphp
                            <span class="px-2 py-1 text-xs font-medium rounded {{ $bgColor }}">
                                {{ ucfirst(str_replace('_', ' ', $return->return_status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.returns.updateNotes', $return->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <select name="product_condition" onchange="this.form.submit()" class="border px-2 py-1 rounded bg-white shadow text-sm">
                                    <option value="">Pilih Kondisi</option>
                                    @foreach (['excellent', 'good', 'fair', 'poor', 'damaged'] as $condition)
                                        <option value="{{ $condition }}" {{ $return->product_condition === $condition ? 'selected' : '' }}>
                                            {{ ucfirst($condition) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            @php
                                $beforePhotos = is_string($return->condition_before)
                                    ? json_decode($return->condition_before, true)
                                    : $return->condition_before;
                            @endphp

                            @if (!empty($beforePhotos))
                                @foreach($beforePhotos as $photo)
                                    <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="text-blue-600 underline text-sm block">Lihat</a>
                                @endforeach
                            @else
                                <span class="text-red-500 font-bold text-sm">Belum</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            @php
                                $afterPhotos = is_string($return->condition_after)
                                    ? json_decode($return->condition_after, true)
                                    : $return->condition_after;
                            @endphp
                                                    
                            @if (!empty($afterPhotos))
                                @foreach($afterPhotos as $photo)
                                    <a href="{{ asset('storage/' . $photo) }}" target="_blank" class="text-blue-600 underline text-sm block">Lihat</a>
                                @endforeach
                            @else
                                <span class="text-red-500 font-bold text-sm">Belum</span>
                            @endif
                        </td>

                        <td class="px-6 py-4">
                            <form action="{{ route('admin.returns.uploadCondition', $return->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block font-semibold mb-1">Before</label>
                                        <input type="file" name="condition_before[]" accept="image/*" multiple class="border rounded p-2 w-full">
                                    </div>
                                    <div>
                                        <label class="block font-semibold mb-1">After</label>
                                        <input type="file" name="condition_after[]" accept="image/*" multiple class="border rounded p-2 w-full">
                                    </div>
                                </div>
                                <button type="submit" class="mt-4 bg-blue-200 text-black px-4 py-2 rounded shadow">Upload</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.returns.updateNotes', $return->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <textarea name="condition_notes" rows="3" class="border rounded p-2 w-full text-sm" placeholder="Catatan kondisi...">{{ $return->condition_notes }}</textarea>
                                <input type="number" name="penalty_amount" step="0.01" min="0" value="{{ $return->penalty_amount }}" class="border rounded p-2 w-full text-sm mt-2" placeholder="Denda (Rp)">
                                <button type="submit" class="mt-2 bg-green-200 text-black px-3 py-1 rounded shadow text-sm">Update</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            @if($return->return_status === 'in_process')
                                <form action="{{ route('admin.returns.confirmReturn', $return->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded shadow hover:bg-green-600" 
                                            onclick="return confirm('Konfirmasi return selesai?')">
                                        Konfirmasi Return
                                    </button>
                                </form>
                            @else
                                <span class="text-green-600 font-semibold">Selesai</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                @if(count($returns) === 0)
                    <tr>
                        <td colspan="11" class="px-6 py-8 text-gray-500 text-center">
                            Belum ada return process yang dimulai
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.getElementById('active-orders-tab').style.display = 'none';
            document.getElementById('returns-tab').style.display = 'none';
            
            // Remove active class from all buttons
            document.getElementById('tab-active-orders').classList.remove('bg-[#d3b9f6]', 'text-white');
            document.getElementById('tab-active-orders').classList.add('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-returns').classList.remove('bg-[#d3b9f6]', 'text-white');
            document.getElementById('tab-returns').classList.add('bg-gray-200', 'text-gray-700');
            
            // Show selected tab
            document.getElementById(tabName + '-tab').style.display = 'block';
            
            // Add active class to selected button
            document.getElementById('tab-' + tabName).classList.remove('bg-gray-200', 'text-gray-700');
            document.getElementById('tab-' + tabName).classList.add('bg-[#d3b9f6]', 'text-white');
        }
    </script>

@endsection