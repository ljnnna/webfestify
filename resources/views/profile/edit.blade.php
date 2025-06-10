<x-app-layout>
    <!-- CONTAINER UTAMA -->
    <div class="flex flex-col md:flex-row bg-gray-50">
        <!-- SIDEBAR -->
         <x-sidebar-profile :user="auth()->user()" />
@extends('layouts.app')

@section('title', 'Edit Profile')

{{-- Desktop Menu --}}
@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Home
    </a>
    <a href="{{ route('catalog') }}"
        class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Catalog
    </a>
    <a href="{{ route('team') }}"
        class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Team
    </a>
    <a href="{{ route('details') }}"
        class="{{ request()->routeIs('details') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Contact
    </a>
    <a href="{{ route('profile.edit') }}"
         class="{{ request()->routeIs('profile.*') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
         Profile
    </a>

</div>
@endsection

@section('content')
<!-- CONTAINER UTAMA -->
<div class=" flex flex-col md:flex-row bg-gray-50 min-h-[80vh]">

    <!-- FORM UTAMA -->
    <main class="flex-1 p-6 flex justify-center items-start">
        <form method="POST" action="{{ route('profile.saveAll') }}"
              class="bg-white rounded-2xl shadow-lg p-8 max-w-3xl w-full mx-auto">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <!-- Username -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700">Username</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <!-- No. Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700">No. Telepon</label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone', auth()->user()->phone) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 mt-1" required>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="address" class="block text-sm font-semibold text-gray-700">Alamat</label>
                    <input type="text" name="address" id="address"
                           value="{{ old('address', auth()->user()->address) }}"
                           class="w-full border border-gray-300 rounded px-3 py-2 mt-1">
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div x-data="{ confirmDelete: false }" class="flex flex-wrap justify-start gap-4 mt-6">
                <template x-if="!confirmDelete">
                    <button type="button" @click="confirmDelete = true"
                            class="bg-red-600 text-white px-4 py-2 rounded shadow hover:bg-red-700 transition">
                        Delete Account
                    </button>
                </template>

                <template x-if="confirmDelete">
                    <button type="submit" name="delete_account" value="on"
                            class="bg-red-700 text-white px-4 py-2 rounded shadow border border-red-900">
                        Are you sure?
                    </button>
                </template>

                <button type="submit"
                        class="bg-gray-300 px-4 py-2 rounded shadow hover:bg-gray-400 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </main>
</div>
@endsection
