<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Our Team')</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

  <!-- AOS (Animate On Scroll) -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  
  <style>
    body {
      font-family: "Inter", sans-serif;
    }
    
    /* Custom responsive styles */
    @media (max-width: 768px) {
      .team-member {
        margin-bottom: 2rem;
      }
      
      .member-info {
        text-align: center !important;
      }
      
      .member-info .flex {
        justify-content: center !important;
      }
      
      .member-avatar {
        width: 150px;
        height: 150px;
        margin: 0 auto 1rem auto;
      }
    }
    
    @media (max-width: 640px) {
      .member-avatar {
        width: 120px;
        height: 120px;
      }
      
      .member-info h2 {
        font-size: 1.25rem !important;
      }
      
      .contact-info {
        flex-direction: column !important;
        gap: 0.5rem !important;
      }
    }
  </style>

  @stack('styles')
</head>
<body class="bg-gradient-to-b from-purple-100 via-pink-100 to-pink-200">
  
  @yield('content')

  <!-- Flowbite JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 1000, once: true });
    feather.replace(); // Feather icon aktif
  </script>

  @stack('scripts')
</body>
</html>