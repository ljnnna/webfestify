 <!-- Navbar -->
  <header class="sticky top-0 z-50 bg-[#E9DFF7] dark:bg-[#1E1B2E] shadow-md text-[#3E3667] dark:text-white">
  <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 h-16">

    <!-- Left Section: Logo & Nav -->
    <div class="flex items-center space-x-6 flex-shrink-0 flex-wrap">
      <img alt="Festify logo" src="{{ asset('images/logofestify.png') }}" class="w-24 h-auto flex-shrink-0" />

      <!-- Desktop Nav -->
      <nav class="hidden md:flex space-x-8 font-semibold text-sm">
        <a class="hover:opacity-35" href="{{ url('/home') }}">HOME</a>
        <a class="hover:opacity-35" href="{{ url('/catalog') }}">CATALOG</a>
        <a class="hover:opacity-35" href="{{ url('/learnmore') }}">LEARN MORE</a>
        <a class="hover:opacity-35" href="https://mail.google.com/mail/?view=cm&fs=1&to=festify2b@gmail.com">CONTACT</a>
      </nav>
    </div>

    <!-- Right Section: Search & Icons -->
    <div class="flex items-center space-x-4">

      <!-- Search 
      <div class="relative w-[200px] hidden md:block">
        <input type="text" placeholder="Search..." class="w-full rounded-full py-2 pl-4 pr-10 text-sm bg-white dark:bg-gray-700 dark:text-white focus:outline-none shadow-inner">
        <i class="fas fa-search absolute right-3 top-2.5 text-gray-500 dark:text-gray-300"></i>
      </div> -->

      <!-- Icons -->
      <a href="{{ url('/chart') }}" aria-label="Cart" class="text-[#3E3667] dark:text-white hover:text-[#6B5DD3] text-lg">
        <i class="fas fa-shopping-cart"></i>
      </a>
      <a href="{{ url('/setting_akun') }}" aria-label="User" class="text-[#3E3667] dark:text-white hover:text-[#6B5DD3] text-lg">
        <i class="fas fa-user-circle"></i>
      </a>

      <!-- Dark Mode Toggle -->
      <button onclick="toggleDarkMode()" class="text-[#3E3667] dark:text-white text-lg">
        <span id="theme-icon">🌙</span>
      </button>

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
      <a class="hover:opacity-35" href="{{ url('/homepage') }}">HOME</a>
      <a class="hover:opacity-35" href="{{ url('/homepage') }}">CATALOG</a>
      <a class="hover:opacity-35" href="{{ url('/about_us') }}">ABOUT US</a>
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
  </html>

  