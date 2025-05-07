<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title')</title>

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Flowbite CSS and JS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js" defer></script>

    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />

    <!-- Flatpickr Date Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: "Inter";
        }
    </style>

</head>
<body class="bg-white">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Scripts -->
    @yield('scripts')
</body>
</html>