<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwiphpndcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-800">Admin</h1>
            </div>
            <nav class="mt-6">
                <div class="px-6 py-3 bg-blue-100 text-blue-600 font-medium">
                    <span>Dashboard</span>
                </div>
                <div class="px-6 py-3 hover:bg-gray-100 text-gray-600 font-medium">
                    <span>User</span>
                </div>
                <div class="px-6 py-3 hover:bg-gray-100 text-gray-600 font-medium">
                    <span>Product</span>
                </div>
                <div class="px-6 py-3 hover:bg-gray-100 text-gray-600 font-medium">
                    <span>Orders</span>
                </div>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Hi, Admin!</h1>
            </div>

            <!-- Customer Overview Section -->
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-gray-700 mb-6">Costumer Overview</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- User Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-gray-500 text-sm font-medium mb-1">User</h3>
                        <p class="text-3xl font-bold text-gray-800">739</p>
                    </div>
                    
                    <!-- Active User Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Active User</h3>
                        <p class="text-3xl font-bold text-blue-600">426</p>
                    </div>
                    
                    <!-- New Signups Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-gray-500 text-sm font-medium mb-1">New Signups</h3>
                        <p class="text-3xl font-bold text-green-600">80</p>
                    </div>
                    
                    <!-- Feedback Received Card -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h3 class="text-gray-500 text-sm font-medium mb-1">Feedback Received</h3>
                        <p class="text-3xl font-bold text-purple-600">209</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>