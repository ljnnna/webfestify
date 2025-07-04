<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>@yield('title')</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap"
            rel="stylesheet"
        />
        <style>
            body {
                font-family: "Inter", sans-serif;
            }
        </style>
    </head>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <body class="bg-gray-100">
        @include('layouts.navigation')
        <main class="w-full pt-4 px-4 sm:px-6 md:px-10">

            @yield('content')
        </main>
    </body>
</html>