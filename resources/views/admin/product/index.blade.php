@extends('layouts.admin')

@section('title', 'Product')

@section('content')
<div x-data="{ showAddModal: false }">
    <!-- Tombol Tambah Produk -->
    <div class="flex justify-center mb-6">
        <button
            @click="showAddModal = true" 
            class="bg-purple-200 text-purple-900 px-4 py-2 rounded-full font-semibold hover:bg-purple-300">
            + Add new product
        </button>
    </div>

    <!-- Modal Tambah Produk -->
    <div
        x-show="showAddModal"
        x-transition
        style="display: none"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <div        
            class="bg-white p-6 rounded-2xl w-full max-w-2xl shadow-lg relative"
            @click.away="showAddModal = false"
        >
            <!-- Tombol close -->
            <button
                @click="showAddModal = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl"
            >
                &times;
            </button>

            <!-- Form Tambah Produk -->
            @include('admin.product._form')
        </div>
    </div>
</div>

<!-- Daftar Produk -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
    @foreach ($products as $product)
        <div x-data="{ editId: null }" @open-edit.window="editId = $event.detail">
            <!-- Komponen Kartu Produk -->
            <x-productcard 
                :product="$product"
                :onEditClick="'showEditModal' . $product->id"
            />

            <!-- Modal Edit Produk -->
            <div 
                x-show="editId === {{ $product->id }}" 
                x-transition style="display: none"
                class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
                <div 
                    class="bg-white p-6 rounded-2xl w-full max-w-2xl shadow-lg relative"
                    @click.away="editId = null">
                    <button 
                        @click="editId = null"
                        class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl">
                            &times;
                    </button>

                    @include('admin.product._update', ['product' => $product, 'categories' => $categories])
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection