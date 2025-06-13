@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div x-data="{ showModal: false }">
    @foreach ($products as $product)
    <div class="relative">
        <x-productcard :product="$product" />

        <!-- Tombol Edit -->
        <div x-data="{ showModal: false }">
            <button 
                @click="showModal = true" 
                class="mt-2 bg-purple-200 text-purple-900 px-4 py-1 rounded-full hover:bg-purple-300">
                ✏️ Edit Product
            </button>

            <!-- Modal -->
            <div x-show="showModal" x-transition style="display: none"
                 class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-2xl w-full max-w-2xl shadow-lg relative"
                     @click.away="showModal = false">
                    
                    <!-- Tombol close -->
                    <button @click="showModal = false"
                            class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl">
                        &times;
                    </button>

                    <!-- Form Edit (KIRIM PRODUK) -->
                    @include('admin.product._update', ['product' => $product])
                </div>
            </div>
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
