<!-- Backdrop (hanya untuk mobile) -->
<div id="sidebarBackdrop" class="fixed inset-0 bg-black bg-opacity-40 z-10 hidden lg:hidden"></div>

<!-- Sidebar dengan mode collapsed -->
<div id="sidebar" class="fixed top-16 left-0 h-[calc(100%-4rem)] border-r bg-white overflow-y-auto z-20 transition-all duration-300 ease-in-out w-64 -translate-x-full lg:translate-x-0">
    <div class="p-4" id="sidebarContent">
        <div class="flex items-center justify-between mb-6">
            <h1 id="sidebarTitle" class="text-[#493862] text-xl font-bold transition-opacity duration-300 opacity-100"></h1>
        </div>
        <nav class="text-[#493862] flex flex-col gap-4">
            <a href="{{ route('admin.home') }}" class="nav-item rounded-full border font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-200' : '' }} flex items-center relative group min-h-[44px] px-4 py-2 gap-3">
                <i class="fas fa-home flex-shrink-0 w-5 text-center"></i>
                <span class="nav-text transition-opacity duration-300 opacity-100 whitespace-nowrap">Dashboard</span>
                <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 pointer-events-none group-hover:opacity-100 transition-all duration-200 whitespace-nowrap z-50 hidden transform -translate-x-1 group-hover:translate-x-0">
                    Dashboard
                </div>
            </a>
            
            <a href="{{ route('admin.user') }}" class="nav-item rounded-full border font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.user') ? 'bg-purple-200' : '' }} flex items-center relative group min-h-[44px] px-4 py-2 gap-3">
                <i class="fas fa-users flex-shrink-0 w-5 text-center"></i>
                <span class="nav-text transition-opacity duration-300 opacity-100 whitespace-nowrap">User</span>
                <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 pointer-events-none group-hover:opacity-100 transition-all duration-200 whitespace-nowrap z-50 hidden transform -translate-x-1 group-hover:translate-x-0">
                    User
                </div>
            </a>
            
            <a href="{{ route('admin.product.index') }}" class="nav-item rounded-full border font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.product.*') ? 'bg-purple-200' : '' }} flex items-center relative group min-h-[44px] px-4 py-2 gap-3">
                <i class="fas fa-box flex-shrink-0 w-5 text-center"></i>
                <span class="nav-text transition-opacity duration-300 opacity-100 whitespace-nowrap">Product</span>
                <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 pointer-events-none group-hover:opacity-100 transition-all duration-200 whitespace-nowrap z-50 hidden transform -translate-x-1 group-hover:translate-x-0">
                    Product
                </div>
            </a>
            
            <a href="{{ route('admin.orders') }}" class="nav-item rounded-full border font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.orders') ? 'bg-purple-200' : '' }} flex items-center relative group min-h-[44px] px-4 py-2 gap-3">
                <i class="fas fa-shopping-cart flex-shrink-0 w-5 text-center"></i>
                <span class="nav-text transition-opacity duration-300 opacity-100 whitespace-nowrap">Orders</span>
                <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 pointer-events-none group-hover:opacity-100 transition-all duration-200 whitespace-nowrap z-50 hidden transform -translate-x-1 group-hover:translate-x-0">
                    Orders
                </div>
            </a>

            <a href="{{ route('admin.returns') }}" class="nav-item rounded-full border font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.returns') ? 'bg-purple-200' : '' }} flex items-center relative group min-h-[44px] px-4 py-2 gap-3">
                <i class="fas fa-truck-pickup flex-shrink-0 w-5 text-center"></i>
                <span class="nav-text transition-opacity duration-300 opacity-100 whitespace-nowrap">Return</span>
                <div class="sidebar-tooltip absolute left-full ml-2 px-2 py-1 bg-gray-800 text-white text-sm rounded opacity-0 pointer-events-none group-hover:opacity-100 transition-all duration-200 whitespace-nowrap z-50 hidden transform -translate-x-1 group-hover:translate-x-0">
                    Return
                </div>
            </a>
        </nav>
    </div>
</div>