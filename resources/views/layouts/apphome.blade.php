<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Festify</title>

    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            keyframes: {
              'fade-in-up': {
                '0%': { opacity: '0', transform: 'translateY(20px) scale(0.9)' },
                '100%': { opacity: '1', transform: 'translateY(0) scale(1)' },
              },
            },
            animation: {
              'fade-in-up': 'fade-in-up 0.8s ease-out forwards',
            },
          }
        }
      }
    </script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Alpine JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Custom Styles -->
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
      @keyframes marquee {
        0% { transform: translateX(100%); }
        100% { transform: translateX(-100%); }
      }
      .animate-marquee {
        display: inline-block;
        animation: marquee 10s linear infinite;
      }
    </style>
  </head>

  <body class="bg-white text-[#3E3667]">
    <!-- Header -->
    @include('layouts.navigation')

    <!-- Main Content -->
    <main>
      @yield('content') 
    </main>

    <!-- Footer -->
    @include('components.footer')
  </body>
</html>
