<x-guest-layout>
    <body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50">
  <div class="w-full max-w-6xl h-auto md:h-[560px] flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden  bg-purple-50">    
<div class="w-full max-w-6xl h-auto md:h-[560px] flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden bg-purple-100">
        <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
      <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
      <h2 class="text-3xl font-bold text-purple-900 text-center">WELCOME!</h2>
      <p class="text-gray-600 mt-3 text-center">Sign in to continue</p>
    </div>

    <!-- Kanan -->
    <form action="{{ route('login') }}" method="POST" class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center space-y-5">
      <h2 class="text-2xl font-bold text-purple-600 text-center">LOGIN</h2>
    @csrf
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
