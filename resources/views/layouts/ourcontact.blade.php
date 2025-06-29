<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Festify')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        .text-purple {
            color: #8B5CF6;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @include('layouts.navigation')
    
    <!-- Main Content -->
    @yield('content')
    
    <!-- Footer (if needed) -->
        <!-- Footer -->
    @include('components.footer')
    
    <!-- Scripts -->
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
    @yield('scripts')
</body>
</html>