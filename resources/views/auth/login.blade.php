<x-guest-layout>
  <body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50">
    <div class="w-full max-w-6xl h-auto md:h-[560px] flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden bg-purple-50">
      
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

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
          @csrf

          <!-- Email -->
          <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
          </div>

          <!-- Password -->
          <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
          </div>

          <!-- Remember Me -->
          <div class="flex justify-between items-center">
            <label class="inline-flex items-center">
              <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500" name="remember">
              <span class="ms-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
              <a class="text-sm text-purple-500 hover:underline" href="{{ route('password.request') }}">
                Forgot Password?
              </a>
            @endif
          </div>

          <!-- Login Button -->
          <div>
            <x-primary-button class="w-full justify-center">
              {{ __('Log in') }}
            </x-primary-button>
          </div>

          <!-- Link Register -->
          <div class="text-center text-sm">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-purple-600 font-semibold hover:underline">Register</a>
          </div>
        </form>
      </div>
    </div>
  </body>
</x-guest-layout>
