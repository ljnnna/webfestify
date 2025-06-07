  <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Festify
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class',
  }
</script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-[#3E3667] dark:bg-[#1E1B2E] dark:text-white">
  <!-- Navbar -->
  <header class="sticky top-0 z-50 bg-gradient-to-r from-[#EAE1F9] to-[#F5EDFB] dark:bg-[#1E1B2E] shadow-md text-[#3E3667] dark:text-white">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
    
    <!-- Left Section: Logo & Nav -->
    <div class="flex items-center space-x-6 flex-shrink-0 flex-wrap">
      <img alt="Festify logo" src="images/logofestify.png" class="w-24 h-auto flex-shrink-0" />
      
      <!-- Desktop Nav -->
      <nav class="hidden md:flex space-x-8 font-semibold text-sm">
        <a class="hover:opacity-35" href="{{ route('dashboard') }}">HOME</a>
        <a class="hover:opacity-35" href="{{ route('catalog') }}">CATALOG</a>
        <a class="hover:opacity-35" href="{{ url('about_us') }}l">ABOUT US</a>
        <a class="hover:opacity-35" href="https://mail.google.com/mail/?view=cm&fs=1&to=festify2b@gmail.com">CONTACT</a>
      </nav>
    </div>

    <!-- Right Section: Search & Icons -->
    <div class="flex items-center space-x-4">
      
      <!-- Search -->
      <div class="relative w-[200px] hidden md:block">
        <input type="text" placeholder="Search..." class="w-full rounded-full py-2 pl-4 pr-10 text-sm bg-white dark:bg-gray-700 dark:text-white focus:outline-none shadow-inner">
        <i class="fas fa-search absolute right-3 top-2.5 text-gray-500 dark:text-gray-300"></i>
      </div>

      <!-- Icons -->
      <a href="chart.html" aria-label="Cart" class="text-[#3E3667] dark:text-white hover:text-[#6B5DD3] text-lg">
        <i class="fas fa-shopping-cart"></i>
      </a>
      
<button id="dropdownUserAvatarButton" data-dropdown-toggle="dropdownAvatar" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" type="button">
  <span class="sr-only">Open user menu</span>
  <img class="w-8 h-8 rounded-full" src="/docs/images/people/profile-picture-3.jpg" alt="user photo">
  </button>
  
  <!-- Dropdown menu -->
  <div id="dropdownAvatar" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
      <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
        <div>Bonnie Green</div>
        <div class="font-medium truncate">name@flowbite.com</div>
      </div>
      <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUserAvatarButton">
        <li>
          <a href="route('dashboard')" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Setting Account</a>
        </li>
        <li>
          <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Info Pembelian</a>
        </li>
      </ul>
      <div class="py-2">
        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
      </div>
  </div>  

      <!-- Mobile Menu Button -->
      <button onclick="openDrawer()" aria-label="Open menu" class="md:hidden text-[#3E3667] dark:text-white text-2xl focus:outline-none">
        <i class="fas fa-bars"></i>
      </button>
    </div>
  </div>
  </header>
  
  <!-- Overlay -->
  <div id="drawer-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden" onclick="closeDrawer()"></div>
  
  <!-- Drawer -->
  <aside id="mobile-drawer" class="fixed top-0 left-0 w-64 h-full bg-white dark:bg-[#2A2544] z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">
    <div class="flex items-center justify-between p-4 border-b border-gray-200 dark:border-gray-600">
      <h2 class="font-bold text-lg">Menu</h2>
      <button onclick="closeDrawer()" class="text-xl text-gray-700 dark:text-white">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <nav class="flex flex-col p-4 space-y-4 font-semibold text-sm">
      <a class="hover:opacity-35" href="{{ route('dashboard') }}">HOME</a>
      <a class="hover:opacity-35" href="{{ route('catalog') }}">CATALOG</a>
      <a class="hover:opacity-35" href="{{ url('about_us') }}">ABOUT US</a>
      <a class="hover:opacity-35" href="https://mail.google.com/mail/?view=cm&fs=1&to=festify2b@gmail.com">CONTACT</a>
    </nav>
  </aside>
  
  <script>
    function openDrawer() {
      document.getElementById('mobile-drawer').classList.remove('-translate-x-full');
      document.getElementById('drawer-overlay').classList.remove('hidden');
    }
  
    function closeDrawer() {
      document.getElementById('mobile-drawer').classList.add('-translate-x-full');
      document.getElementById('drawer-overlay').classList.add('hidden');
    }
  
    function toggleDarkMode() {
      const html = document.documentElement;
      html.classList.toggle('dark');
      const icon = document.getElementById('theme-icon');
      icon.textContent = html.classList.contains('dark') ? '☀️' : '🌙';
    }
  </script>
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>

  </body>


  