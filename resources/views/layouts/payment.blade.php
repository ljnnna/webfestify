<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <title>@yield('title')</title>

        <!-- Flowbite CSS -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"
            rel="stylesheet"
        />

        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Font Awesome -->
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            rel="stylesheet"
        />

        <style>
            @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap");
            body {
                font-family: "Inter", sans-serif;
            }
        </style>

        <!-- Additional Styles -->
        @stack('styles')
    </head>
    <body class="@yield('body-class', 'bg-gray-100 min-h-screen')">
        <main>@yield('content')</main>
    </body>
</html>
