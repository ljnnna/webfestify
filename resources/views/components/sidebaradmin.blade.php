<!-- Sidebar Normal -->
<div id="sidebar" class="fixed top-16 left-0 w-64 h-[calc(100%-4rem)] border-r bg-white overflow-y-auto z-20 transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="p-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-[#493862] text-xl font-bold">Hi, Admin!</h1>
        </div>
        <nav class="text-[#493862] flex flex-col gap-4">
            <a href="{{ route('admin.home') }}" class="nav-item rounded-full border px-4 py-2 font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-200' : '' }} flex items-center justify-center lg:justify-start gap-3">
                <i class="fas fa-home"></i>
                <span class="nav-text">Dashboard</span>
            </a>
            
            <a href="{{ route('admin.user') }}" class="nav-item rounded-full border px-4 py-2 font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.user') ? 'bg-purple-200' : '' }} flex items-center justify-center lg:justify-start gap-3">
                <i class="fas fa-users"></i>
                <span class="nav-text">User</span>
            </a>
            
            <a href="{{ route('admin.product.index') }}" class="nav-item rounded-full border px-4 py-2 font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.product.*') ? 'bg-purple-200' : '' }} flex items-center justify-center lg:justify-start gap-3">
                <i class="fas fa-box"></i>
                <span class="nav-text">Product</span>
            </a>
            
            <a href="{{ route('admin.orders') }}" class="nav-item rounded-full border px-4 py-2 font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.orders') ? 'bg-purple-200' : '' }} flex items-center justify-center lg:justify-start gap-3">
                <i class="fas fa-shopping-cart"></i>
                <span class="nav-text">Orders</span>
            </a>
        </nav>
    </div>
</div>