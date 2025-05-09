<x-guest-layout>

    <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
        <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
        <h2 class="text-3xl font-bold text-purple-900 text-center">HELLO!</h2>
        <p class="text-gray-600 mt-3 text-center">Create your </p>
    </div>

    <!-- Form start -->
    <form method="POST" action="{{ route('register') }}" class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center space-y-5">
        @csrf

        <h2 class="text-2xl font-bold text-purple-600 text-center">REGISTER</h2>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
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

        <div class="flex flex-col items-center mt-4 space-y-4">

         <!-- Tombol Register -->
            <x-primary-button class="w-full justify-center text-center py-3 text-base">
                {{ __('Register') }}
            </x-primary-button>

        
            <a class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }} ">
                {{ __('Already registered?') }}
            </a>
        </div>

    </form>
</x-guest-layout>
