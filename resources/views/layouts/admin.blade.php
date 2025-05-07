<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="h-screen overflow-hidden bg-white">
    {{-- Navbar --}}
    <x-navbaradmin />

    {{-- Sidebar --}}
    <x-sidebaradmin />

    {{-- Main content --}}
    <main class="ml-64 mt-16 h-[calc(100%-4rem)] overflow-y-auto p-6">
        @yield('content')
    </main>
</body>
</html>