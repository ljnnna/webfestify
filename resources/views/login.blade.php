<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
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
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50">
  <div class="w-full max-w-6xl h-auto md:h-[560px] flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden  bg-purple-50">

    <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
      <img src="{{ asset('images/logofestify.png') }}" alt="Festify Logo" class="w-40 md:w-44 mb-6 animate-float">
      <h2 class="text-3xl font-bold text-gray-800 text-center">WELCOME!</h2>
      <p class="text-gray-600 mt-3 text-center">Sign in to continue</p>
    </div>

    <!-- Kanan -->
    <form action="{{ route('login') }}" method="POST" class="w-full md:w-1/2 bg-white p-10 flex flex-col justify-center space-y-5">
      <h2 class="text-2xl font-bold text-purple-600 text-center">LOGIN</h2>
    @csrf

    <!-- notif error -->
    @if ($errors->any())
    <div class="text-red-500 text-sm text-center">
        {{ $errors->first() }}
    </div>
    @endif

      <!-- Email -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Email</label>
        <input name="email" type="text" placeholder="Enter Email"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
      </div>

      <!-- Password -->
      <div>
        <label class="text-sm text-purple-600 mb-1 block">Password</label>
        <input name="password" type="password" placeholder="Enter Password"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
      </div>

      <!-- submit -->
      <div>
        <button type="submit"
          class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 rounded-full transition duration-300">
          Login
        </button>
      </div>

      <!-- Link register -->
      <div class="text-center text-sm">
        Don’t have an account?
        <a href="{{ route ('register') }}" class="text-purple-600 font-semibold hover:underline">Register</a>
      </div>
    </form>
  </div>
</body>
</html>
