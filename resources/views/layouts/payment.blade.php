<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>@yield('title', 'Payment - Festify')</title>

    <!-- Flowbite CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap");
        
        body {
            font-family: "Inter", sans-serif;
        }
        
        /* Custom Transitions */
        .transition-smooth {
            transition: all 0.3s ease-in-out;
        }
        
        /* Hover Effects */
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        
        /* Payment method button active state */
        .payment-method-active {
            border-color: #B6B0F7 !important;
            background-color: rgba(249, 217, 255, 0.2) !important;
        }
        
        /* Remove any default borders and outlines */
        .no-border {
            border: none !important;
            outline: none !important;
        }
        
        /* Custom focus styles without borders */
        .search-input:focus {
            outline: none !important;
            box-shadow: 0 0 0 2px rgba(182, 176, 247, 0.3) !important;
        }
        
        /* Button styles */
        button:focus {
            outline: none !important;
        }
        
        /* Custom button hover effects */
        .btn-hover:hover {
            transform: scale(1.02);
            transition: all 0.2s ease-in-out;
        }
    </style>

    @yield('extra-css')
</head>
<body class="@yield('body-class', 'bg-gray-100 min-h-screen')">
    <main>
        @yield('content')
    </main>
    
    <!-- Flowbite JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    
    @yield('scripts')
</body>
</html>