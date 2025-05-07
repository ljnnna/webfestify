<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-10px);
      }
    }
    .animate-float {
      animation: float 3s ease-in-out infinite;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50 p-4">
  <div class="w-full max-w-6xl flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden bg-purple-50">

    <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
      <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
      <h2 class="text-3xl font-bold text-gray-800 text-center">WELCOME!</h2>
      <p class="text-gray-600 mt-3 text-center">Sign in to continue</p>
    </div>
    
    <!-- Kanan -->
    <form action="{{ route('login') }}" method="POST" class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center space-y-5">
      <h2 class="text-2xl font-bold text-purple-600 text-center">REGISTER</h2>
    @csrf


      <!-- Flash Message Success -->
      @if (session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded-md text-center text-sm">
          {{ session('success') }}
        </div>
      @endif

      <!-- Full Name -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Full Name</label>
        <input name="full_name" type="text" placeholder="Enter Full Name" value="{{ old('full_name') }}"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
        @error('full_name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Username -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Username</label>
        <input name="username" type="text" placeholder="Enter Username" value="{{ old('username') }}"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
        @error('username')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Contact Number -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Contact Number</label>
        <input name="contact_number" type="text" placeholder="Enter Contact Number" value="{{ old('contact_number') }}"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
        @error('contact_number')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Email -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Email</label>
        <input name="email" type="email" placeholder="Enter Email" value="{{ old('email') }}"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
        @error('email')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Password -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Password</label>
        <input name="password" type="password" placeholder="Enter Password"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
        @error('password')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <!-- Confirmation Password -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Confirmation Password</label>
        <input name="password_confirmation" type="password" placeholder="Enter Confirmation Password"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
      </div>

      <!-- Submit -->
      <div>
        <button type="submit"
          class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-full transition duration-300">
          Register
        </button>
      </div>

      <!-- Link Login -->
      <div class="text-center text-sm">
        Already have an account?
        <a href="{{ route('login') }}" class="text-purple-600 font-semibold hover:underline">Login</a>
      </div>
    </form>
  </div>
</body>
</html>
