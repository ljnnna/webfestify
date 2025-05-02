@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')
    <h1 class="text-2xl font-bold text-[#493862] mb-6">Add New Product</h1>

    <div class="bg-white p-6 rounded-2xl shadow-md max-w-3xl mx-auto">
        @include('product._form')
    </div>
@endsection
