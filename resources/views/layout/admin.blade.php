<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md px-4 py-6">
            <div class="text-2xl font-bold text-purple-700 mb-10">Festify Admin</div>
            <nav class="flex flex-col space-y-4">
                <a href="#" class="text-gray-700 hover:text-purple-600">Dashboard</a>
                <a href="#" class="text-gray-700 hover:text-purple-600">User</a>
                <a href="#" class="text-gray-700 hover:text-purple-600">Product</a>
                <a href="#" class="text-gray-700 hover:text-purple-600">Orders</a>
            </nav>
        </aside>

        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
                <div class="text-xl font-bold text-purple-600">Logo Festify</div>
                <div class="flex items-center space-x-6">
                    <span class="text-gray-700">Halo, {{ Auth::user()->username ?? 'Guest' }}</span>
                    <button class="text-gray-600 hover:text-purple-600 text-xl">🔔</button>
                    <button class="text-gray-600 hover:text-purple-600 text-xl">👤</button>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
