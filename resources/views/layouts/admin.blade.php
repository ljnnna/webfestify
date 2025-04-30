<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') | Admin Panel</title>
    <!-- Hapus referensi vite sepenuhnya, bukan hanya dikomentari -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tambahkan konfigurasi Tailwind untuk warna kustom -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        purple: {
                            light: '#e3d3f9',
                            medium: '#cbb0ec',
                            dark: '#3a2e52'
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#f9f9fb] text-[#3a2e52] font-inter">
    <!-- Template content tetap sama -->
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r flex flex-col p-6">
            <h2 class="text-2xl font-bold mb-6">Hi, Admin!</h2>
            <nav class="space-y-4">
                <a href="/dashboard" class="block py-2 px-4 rounded-full text-center font-semibold bg-[#e3d3f9] text-[#3a2e52] hover:bg-[#cbb0ec]">Dashboard</a>
                <a href="/users" class="block py-2 px-4 rounded-full text-center hover:bg-[#eee]">User</a>
                <a href="/products" class="block py-2 px-4 rounded-full text-center hover:bg-[#eee]">Product</a>
                <a href="/orders" class="block py-2 px-4 rounded-full text-center hover:bg-[#eee]">Orders</a>
            </nav>
        </aside>

        <!-- Content -->
        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="flex items-center justify-between px-6 py-4 border-b bg-white">
            <div></div>
            <div class="text-xl font-bold">
                <img src="images\logofestify.png" alt="Festify Logo" class="h-10">
            </div>
            <div class="flex items-center gap-4">
                <button>🔔</button>
                <button>👤</button>
            </div>
        </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>