<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - @yield('title')</title>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white">
    {{-- Navbar --}}
    <x-navbaradmin />

    {{-- Sidebar --}}
    <x-sidebaradmin />
    <!-- Backdrop -->
    <div id="sidebarBackdrop" class="fixed inset-0 bg-black bg-opacity-50 z-10 hidden lg:hidden"></div>

    {{-- Main content --}}
    <main id="mainContent" class="mt-20 min-h-screen p-6 transition-all duration-300 ml-64">
        @yield('content')
    </main>

    {{-- Script --}}
    @yield('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const sidebar = document.getElementById("sidebar");
            const sidebarContent = document.getElementById("sidebarContent");
            const mainContent = document.getElementById("mainContent");
            const toggleBtn = document.getElementById("sidebarToggle");
            const backdrop = document.getElementById("sidebarBackdrop");
            const sidebarTitle = document.getElementById("sidebarTitle");
            const navTexts = document.querySelectorAll(".nav-text");
            const tooltips = document.querySelectorAll(".sidebar-tooltip");
            const navItems = document.querySelectorAll(".nav-item");

            let isCollapsed = false;

            toggleBtn.addEventListener("click", function () {
                // Check if mobile
                if (window.innerWidth < 1024) {
                    // Mobile behavior - hide/show sidebar
                    sidebar.classList.toggle("-translate-x-full");
                    backdrop.classList.toggle("hidden");
                    return;
                }

                // Desktop behavior - collapse/expand
                isCollapsed = !isCollapsed;
                
                if (isCollapsed) {
                    // Mode collapsed - hanya tampilkan icon
                    sidebar.classList.remove("w-64");
                    sidebar.classList.add("w-16");
                    
                    // Adjust main content margin
                    mainContent.classList.remove("ml-64");
                    mainContent.classList.add("ml-16");
                    
                    // Adjust sidebar content padding
                    sidebarContent.classList.remove("p-4");
                    sidebarContent.classList.add("p-2");
                    
                    // Adjust nav items untuk center icon
                    navItems.forEach(item => {
                        item.classList.remove("px-4", "gap-3");
                        item.classList.add("px-2", "justify-center");
                    });
                    
                    // Sembunyikan text dan title
                    sidebarTitle.classList.add("opacity-0");
                    navTexts.forEach(text => {
                        text.classList.add("opacity-0");
                        setTimeout(() => {
                            text.classList.add("hidden");
                        }, 150);
                    });
                    
                    // Tampilkan tooltips setelah animasi selesai
                    setTimeout(() => {
                        tooltips.forEach(tooltip => {
                            tooltip.classList.remove("hidden");
                        });
                    }, 300);
                    
                } else {
                    // Mode expanded - tampilkan text
                    sidebar.classList.remove("w-16");
                    sidebar.classList.add("w-64");
                    
                    // Adjust main content margin
                    mainContent.classList.remove("ml-16");
                    mainContent.classList.add("ml-64");
                    
                    // Adjust sidebar content padding
                    sidebarContent.classList.remove("p-2");
                    sidebarContent.classList.add("p-4");
                    
                    // Adjust nav items untuk normal layout
                    navItems.forEach(item => {
                        item.classList.remove("px-2", "justify-center");
                        item.classList.add("px-4", "gap-3");
                    });
                    
                    // Sembunyikan tooltips
                    tooltips.forEach(tooltip => {
                        tooltip.classList.add("hidden");
                    });
                    
                    // Tampilkan text dan title
                    setTimeout(() => {
                        navTexts.forEach(text => {
                            text.classList.remove("hidden");
                            setTimeout(() => {
                                text.classList.remove("opacity-0");
                            }, 50);
                        });
                        sidebarTitle.classList.remove("opacity-0");
                    }, 150);
                }
            });

            // Mobile backdrop click
            backdrop.addEventListener("click", function () {
                sidebar.classList.add("-translate-x-full");
                backdrop.classList.add("hidden");
            });

            // Handle window resize
            window.addEventListener("resize", function () {
                if (window.innerWidth >= 1024) {
                    // Desktop - ensure proper margins
                    backdrop.classList.add("hidden");
                    sidebar.classList.remove("-translate-x-full");
                    
                    if (isCollapsed) {
                        mainContent.classList.remove("ml-64");
                        mainContent.classList.add("ml-16");
                    } else {
                        mainContent.classList.remove("ml-16");
                        mainContent.classList.add("ml-64");
                    }
                } else {
                    // Mobile - reset to mobile behavior
                    mainContent.classList.remove("ml-64", "ml-16");
                    sidebar.classList.add("-translate-x-full");
                }
            });
        });
    </script>
</body>
</html>