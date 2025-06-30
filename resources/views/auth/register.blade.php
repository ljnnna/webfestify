<x-guest-layout>
    <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
        <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
        <h2 class="text-3xl font-bold text-purple-900 text-center">WELCOME!</h2>
        <p class="text-gray-600 mt-3 text-center">Sign in to continue</p>
    </div>

    <!-- Kanan -->
    <div class="w-full md:w-1/2 flex flex-col bg-white min-h-[560px] max-h-screen">
        <div class="flex-1 overflow-auto p-10 no-scrollbar">
            <h2 class="text-2xl font-bold text-purple-600 text-center">REGISTER</h2>

            <!-- Status Session -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form start -->
            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

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

                <div class="mt-2 w-full flex flex-col justify-center items-center px-4 min-h-[100px]">
                    <div class="inline-block transform scale-[0.75] sm:scale-100 origin-top">
                    {!! NoCaptcha::display() !!}
                    </div>
                    {!! NoCaptcha::renderJs() !!}

                    <!-- Error Message Centered Below CAPTCHA -->
                    @if ($errors->has('g-recaptcha-response'))
                    <div class="w-full text-center mt-2">
                        <span class="text-red-500 text-sm">
                            {{ $errors->first('g-recaptcha-response') }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Tombol Register -->
                <div class="mt-6 text-center">
                    <x-primary-button class="w-full justify-center text-center py-3 text-base">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>

                <a class="text-center block text-sm text-gray-600 hover:text-gray-900 mt-4" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </form>
        </div>
    </div>
</x-guest-layout>



