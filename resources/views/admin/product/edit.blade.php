@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div x-data="{ showModal: false }">
        <!-- Tombol untuk membuka modal -->
        <div class="flex justify-center mb-6">
            <button
                @click="showModal = true" 
                class="bg-purple-200 text-purple-900 px-4 py-2 rounded-full font-semibold hover:bg-purple-300">
            + Add new product
            </button>
        </div>

        <!-- Modal -->
        <div
            x-show="showModal"
            x-transition
            style="display: none"
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
        >
            <div        
            class="bg-white p-6 rounded-2xl w-full max-w-2xl shadow-lg relative"
            @click.away="showModal = false"
            >
            <!-- Tombol close -->
                <button
                    @click="showModal = false"
                    class="absolute top-3 right-3 text-gray-500 hover:text-black text-2xl"           
                >
        
                &times;
                </button>

                <!-- Konten form/modal -->
                @include('admin.product._update')
            </div>
        </div>
    </div>

    


    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach ($products as $product)
            <x-productcard :product="$product" />
        @endforeach
    </div>

            <!-- Tombol Hapus -->
            <form action="{{ route('admin.product.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:underline">Hapus Produk</button>
            </form>
        </div>
    </form>
    </div>
@endsection
