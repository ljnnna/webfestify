<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Rent The Vibe'))</title>

    {{-- Tailwind via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        darkMode: 'class',
      }
    </script>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
      body {
        font-family: 'Inter', sans-serif;
      }
    </style>

    {{-- Vite CSS/JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-white text-[#3E3667] dark:bg-[#1E1B2E] dark:text-white">
    @include('layouts.navigation')

    @isset($header)
      <header class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          {{ $header }}
        </div>
      </header>
    @endisset

    <main>
      @yield('content') {{-- Untuk halaman biasa --}}
      {{ $slot ?? '' }}   {{-- Untuk komponen Blade (misalnya <x-app-layout>) --}}
    </main>

    @include('components.footer')
  </body>
</html>



