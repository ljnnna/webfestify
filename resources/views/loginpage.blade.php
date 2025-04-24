<div>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google reCAPTCHA v2 -->
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
  <div class="w-full max-w-5xl h-auto md:h-[540px] flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden">
    
    <!-- Kiri -->
    <div class="w-full md:w-1/2 flex flex-col items-center justify-center bg-transparent p-10">
      <img src="images/festify_logo.png" alt="Festify Logo" class="w-42 md:w-42 mb-4 md:mb-6 animate-float">
      <h2 class="text-2xl md:text-3xl font-bold text-gray-800 text-center">WELCOME!</h2>
      <p class="text-gray-600 mt-2 text-center">Sign in to continue</p>
    </div>
    
    <!-- Kanan -->
    <form action="/login" method="POST" class="w-full md:w-1/2 bg-white p-8 md:p-10 flex flex-col justify-center">
      <h2 class="text-xl md:text-2xl font-bold text-purple-600 text-center mb-6">LOGIN</h2>

      <!-- Username -->
      <div class="mb-4">
        <label class="text-sm text-purple-600 mb-1 block">Username</label>
        <input name="username" type="text" placeholder="Enter Username" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
      </div>

      <!-- Password -->
      <div class="mb-4">
        <label class="text-sm text-purple-600 mb-1 block">Password</label>
        <input name="password" type="password" placeholder="Enter Password" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-300">
      </div>

      <!-- Google reCAPTCHA v2 -->
      <div class="mb-4 flex justify-center">
        <div class="g-recaptcha" data-sitekey="6LeOhx8rAAAAANRDUkVnBABq9MSzOlydp0gUycNx"></div>
      </div>

      <!-- Load reCAPTCHA script -->
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>

      <!-- Tombol login -->
      <div class="mb-4">
        <button type="submit" class="bg-purple-400 hover:bg-purple-500 text-white text-sm font-semibold py-1.5 px-6 rounded-full transition duration-300 mx-auto block">
          Login
        </button>
      </div>

      <!-- Link register -->
      <div class="text-center text-sm">
        Don’t have an account? <a href="register.html" class="text-purple-600 font-semibold hover:underline">Register</a>
      </div>
    </form>
  </div>
</body>
</html>

</div>
