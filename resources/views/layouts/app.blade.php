<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', config('app.name', 'Rent The Vibe'))</title>

  {{-- Tailwind & Flowbite --}}
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

  {{-- AlpineJS --}}
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <script>
    tailwind.config = {
      darkMode: 'class',
    };
  </script>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />

  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>

  {{-- Vite --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body class="flex flex-col min-h-screen">
  {{-- Navbar --}}
  @include('layouts.navigation')

  @include('components.navbar')

  {{-- Optional header --}}
  @isset($header)
    <header class="bg-white dark:bg-gray-800 shadow">
      <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        {{ $header }}
      </div>
    </header>
  @endisset

  {{-- Main content that grows --}}
  <main class="flex-1">
    @yield('content')
  </main>

  {{-- Footer stays at the bottom --}}
  @include('components.footer')
</body>
</html>
