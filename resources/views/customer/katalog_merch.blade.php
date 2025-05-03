<html lang="en">
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
  <header class="fixed top-0 left-0 w-full z-50 bg-[#E9DFF7] dark:bg-[#1E1B2E] shadow-md text-[#3E3667] dark:text-white">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">
      <div class="flex items-center space-x-6">
        <img alt="Festify logo" src="image/logofestify.png" width="100" height="80" />
        <nav class="hidden md:flex space-x-8 font-semibold text-sm">
          <a class="hover:opacity-35" href="homepage.html">HOME</a>
          <a class="hover:opacity-35" href="#category">CATEGORY</a>
          <a class="hover:opacity-35" href="about_us.html">ABOUT US</a>
          <a class="hover:opacity-35" href="https://mail.google.com/mail/?view=cm&fs=1&to=festify2b@gmail.com">CONTACT</a>
        </nav>
      </div>
  
      <div class="flex items-center space-x-4">
        <!-- Search -->
        <div class="relative w-[280px]">
          <input type="text" placeholder="Search..." class="w-full rounded-full py-2 pl-4 pr-10 text-sm bg-white dark:bg-gray-700 dark:text-white focus:outline-none shadow-inner">
          <i class="fas fa-search absolute right-3 top-2.5 text-gray-500 dark:text-gray-300"></i>
        </div>
        <!-- Icons -->
        <a href="chart.html" aria-label="Cart" class="text-[#3E3667] dark:text-white hover:text-[#6B5DD3] text-lg">
          <i class="fas fa-shopping-cart"></i>
        </a>
        <a href="setting_akun.html" aria-label="User" class="text-[#3E3667] dark:text-white hover:text-[#6B5DD3] text-lg">
          <i class="fas fa-user-circle"></i>
        </a>
        <!-- Dark Mode Toggle -->
        <button onclick="toggleDarkMode()" class="text-[#3E3667] dark:text-white text-lg">
          <span id="theme-icon">🌙</span>
        </button>
        <button onclick="openDrawer()" aria-label="Open menu" class="md:hidden text-[#3E3667] dark:text-white text-2xl focus:outline-none">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </header>
  <div class="h-16"></div>
  
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
      <a class="hover:opacity-35" href="homepage.html">HOME</a>
      <a class="hover:opacity-35" href="#category">CATEGORY</a>
      <a class="hover:opacity-35" href="about_us.html">ABOUT US</a>
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
  </body>
    
  </html>
  <main class="flex flex-col md:flex-row gap-8 px-4 sm:px-6 md:px-10 py-10 max-w-[1280px] mx-auto">

   <!-- Filter Sidebar -->
   <aside class="bg-gradient-to-b from-[#FDE9FF] to-[#E6E9FF] rounded-xl p-6 w-full max-w-sm shadow-md shadow-[#D9C9F9]">
    <h2 class="text-[#34006C] font-semibold text-2xl mb-4 border-b border-[#3B2F5C] pb-2">
     Filter
    </h2>
    <section class="mb-8">
     <h3 class="text-[#34006C] font-semibold mb-3">
      Category
     </h3>
     <form class="space-y-3 text-[#493862] text-sm font-normal">
      <label class="flex items-center space-x-2">
       <input class="accent-[#493862]" name="category" type="radio"/>
       <span>
        Electronics
       </span>
      </label>
      <label class="flex items-center space-x-2">
       <input checked="" class="accent-[#493862]" name="category" type="radio"/>
       <span>
        Merchandise
       </span>
      </label>
      <label class="flex items-center space-x-2">
       <input class="accent-[#493862]" name="category" type="radio"/>
       <span>
        Electronics
       </span>
      </label>
     </form>
    </section>
    <section class="mb-6">
     <h3 class="text-[#34006C] font-semibold mb-3">
      Price
     </h3>
     <input class="w-full accent-[#6B5B8A]" max="500000" min="0" type="range" value="250000"/>
     <p class="text-xs text-[#493862] mt-1">
      0 - 500000
     </p>
    </section>
    <button class="w-full bg-[#6D5983] text-white font-bold py-3 rounded-lg hover:bg-[#5a4a75] transition">
     RESET
    </button>
   </aside>

   <!-- Product Grid -->
   <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1">
      
    <!-- Repeat 6 product cards -->
    <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
     <img alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle" class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/e157b278-ecab-48cc-d16b-a079051e6466.jpg" width="250"/>
     <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
      Lightstick Seventeen
     </h3>
     <p class="text-[#493862] text-xs w-full mb-4">
      Rp250.000/day
     </p>
     <button class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px]">
      Details
     </button>
    </article>
    <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
     <img alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle" class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/e157b278-ecab-48cc-d16b-a079051e6466.jpg" width="250"/>
     <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
      Lightstick Seventeen
     </h3>
     <p class="text-[#493862] text-xs w-full mb-4">
      Rp250.000/day
     </p>
     <button class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px]">
      Details
     </button>
    </article>
    <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
     <img alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle" class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/e157b278-ecab-48cc-d16b-a079051e6466.jpg" width="250"/>
     <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
      Lightstick Seventeen
     </h3>
     <p class="text-[#493862] text-xs w-full mb-4">
      Rp250.000/day
     </p>
     <button class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px]">
      Details
     </button>
    </article>
    <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
     <img alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle" class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/e157b278-ecab-48cc-d16b-a079051e6466.jpg" width="250"/>
     <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
      Lightstick Seventeen
     </h3>
     <p class="text-[#493862] text-xs w-full mb-4">
      Rp250.000/day
     </p>
     <button class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px]">
      Details
     </button>
    </article>
    <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
     <img alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle" class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/e157b278-ecab-48cc-d16b-a079051e6466.jpg" width="250"/>
     <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
      Lightstick Seventeen
     </h3>
     <p class="text-[#493862] text-xs w-full mb-4">
      Rp250.000/day
     </p>
     <button class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px]">
      Details
     </button>
    </article>
    <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
     <img alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle" class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250" src="https://storage.googleapis.com/a1aa/image/e157b278-ecab-48cc-d16b-a079051e6466.jpg" width="250"/>
     <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
      Lightstick Seventeen
     </h3>
     <p class="text-[#493862] text-xs w-full mb-4">
      Rp250.000/day
     </p>
     <button class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px]">
      Details
     </button>
    </article>
   </section>
  </main>
 </body>
</html>