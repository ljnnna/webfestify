<div class="fixed top-16 left-0 w-64 h-[calc(100%-4rem)] border-r p-4 bg-white overflow-y-auto z-10">
    <h1 class="text-[#493862] text-xl font-bold mb-6">Hi, Admin!</h1>
    <nav class="text-[#493862] flex flex-col gap-4">
    <a href="{{ route('admin.dashboard') }}" class="rounded-full border px-4 py-2 text-center font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.dashboard') ? 'bg-purple-200' : '' }}">Dashboard</a>

    <a href="{{ route('admin.user') }}" class="rounded-full border px-4 py-2 text-center font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.user') ? 'bg-purple-200' : '' }}">User</a>

    <a href="{{ route('admin.product.index') }}" class="rounded-full border px-4 py-2 text-center font-semibold hover:bg-purple-100 {{ request()->routeIs('admin.product.*') ? 'bg-purple-200' : '' }}">Product</a>

    <a href="{{ route('admin.orders') }}" class="rounded-full border px-4 py-2 text-center font-semibold hover:bg-purple-100">Orders</a>
</nav>
</div>
