<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ config('app.name', 'Festify') }} | Login</title>

    <!-- Custom Font & CSS -->
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

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
    
    .no-scrollbar::-webkit-scrollbar {
        display: none; 
    }

    .no-scrollbar {
        scrollbar-width: none;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50">
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-purple-100 to-purple-50">
    <div class="w-full max-w-6xl h-auto md:h-[560px] flex flex-col md:flex-row rounded-3xl shadow-2xl overflow-hidden bg-purple-50">



            <!-- Content Slot (Login/Register Forms) -->
            {{ $slot }}
          </div>
      </div>
    
</body>
</html>
