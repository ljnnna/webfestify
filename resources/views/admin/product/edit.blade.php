@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    @foreach ($products as $product)
    <div class="relative">
        <x-productcard :product="$product" />

        <!-- Tombol Edit -->
        <div x-data="{ editId: false }">
            <button 
                @click="editId = {{ $product->id }}" 
                class="mt-2 bg-purple-200 text-purple-900 px-4 py-1 rounded-full hover:bg-purple-300">
                ✏️ Edit Product
            </button>

            <!-- Modal -->
            @include('admin.product._update', ['product' => $product])
        </div>

        <!-- Tombol Hapus -->
        <form action="{{ route('admin.product.destroy', $product->slug) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:underline">Hapus Produk</button>
        </form>
    </div>
@endforeach

@endsection