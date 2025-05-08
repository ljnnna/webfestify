<x-guest-layout>
    <!-- Kiri -->
      <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
        <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
        <h2 class="text-3xl font-bold text-purple-900 text-center">Lost your password?</h2>
        <p class="text-gray-600 mt-3 text-center">No worries! Enter your email to reset it!</p>
      </div>

      <!-- Kanan -->
      <div class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center space-y-5">
        <h2 class="text-2xl font-bold text-purple-600 text-center">FORGOT PASSWORD</h2>


    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center mt-4 space-y-4">
            <x-primary-button class="w-full justify-center text-center py-3 text-base">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
