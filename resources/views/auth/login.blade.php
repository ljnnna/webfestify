<x-guest-layout>

    <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
        <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
        <h2 class="text-3xl font-bold text-purple-900 text-center">WELCOME!</h2>
        <p class="text-gray-600 mt-3 text-center">Sign in to continue</p>
    </div>

    <!-- Kanan -->
    <div class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center space-y-5">
        <h2 class="text-2xl font-bold text-purple-600 text-center">LOGIN</h2>

        <!-- Status Session -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        @if(session('message'))
        <div class="mb-4 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded">
            <div class="flex items-center">
                <i class="fas fa-info-circle mr-2"></i>
                {{ session('message') }}
            </div>
        </div>
        @endif

        <!-- ✅ BAGIAN INI TELAH DIPERBAIKI -->
        @if(session('message'))

            <div class="mb-4 p-4 bg-blue-100 border border-blue-400 text-blue-700 rounded">
                <div class="flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    {{ session('message') }}
                </div>
            </div>
        @endif
        <!-- ✅ END PERBAIKAN -->

        

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between items-center">
                <label class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                <a class="text-sm text-purple-500 hover:underline" href="{{ route('password.request') }}">
                    Forgot Password?
                </a>
                @endif
            </div>

            @include('components.capca-session')

            <!-- Login Button -->
            <div class="mt-6 text-center">
                <x-primary-button class="w-full justify-center text-center py-3 text-base">
                    {{ __('Login') }}
                </x-primary-button>
            </div>

            <!-- Link Register -->
            <div class="mt-6 text-center">
                <a class=" text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    href="{{ route('register') }} ">
                    {{ __('Dont have an account?') }}
                </a>
            </div>
        </form>

</x-guest-layout>
