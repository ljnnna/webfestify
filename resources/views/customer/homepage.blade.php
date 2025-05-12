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
        <img alt="Festify logo" src="images/logofestify.png" width="100" height="80" />
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
  <!-- Hero with search bar -->
  <section class="relative max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <img
      alt="Colorful abstract"
      class="w-full rounded-lg shadow-lg"
      src="images/4.png"
      width="1200"
      height="180"
    />
  
    <form id="searchForm"
      class="absolute bottom-6 left-1/2 transform -translate-x-1/2 w-[90%] max-w-3xl
             bg-[#E9DFF7] bg-opacity-80 backdrop-blur-sm rounded-xl shadow-md
             flex flex-nowrap items-center overflow-x-auto divide-x divide-[#3E3667]">
  
      <!-- PRODUCT -->
      <div class="flex-1 min-w-[80px] px-4 py-3 relative">
        <input
          type="text"
          name="product"
          placeholder="PRODUCT"
          class="w-full text-xs font-semibold text-[#3E3667] bg-transparent
                 focus:outline-none placeholder:text-[#3E3667] border-b-2 border-transparent focus:border-[#3E3667] transition-all duration-200"
          required
        />
      </div>
  
      <!-- START DATE -->
      <div class="flex-1 min-w-[80px] px-4 py-3 relative">
        <input
          type="text"
          id="startDate"
          name="start_date"
          placeholder="DAY START"
          class="w-full text-xs font-semibold text-[#3E3667] bg-transparent
                 focus:outline-none placeholder:text-[#3E3667] border-b-2 border-transparent focus:border-[#3E3667] transition-all duration-200"
          required
        />
      </div>
  
      <!-- END DATE -->
      <div class="flex-1 min-w-[80px] px-4 py-3 relative">
        <input
          type="text"
          id="endDate"
          name="end_date"
          placeholder="DAY END"
          class="w-full text-xs font-semibold text-[#3E3667] bg-transparent
                 focus:outline-none placeholder:text-[#3E3667] border-b-2 border-transparent focus:border-[#3E3667] transition-all duration-200"
          required
        />
      </div>
  
      <!-- SEARCH BUTTON -->
      <button
        id="searchBtn"
        aria-label="Search"
        type="submit"
        class="flex-shrink-0 px-4 py-3 text-[#3E3667] hover:text-[#6B5DD3] transition-all duration-200 hover:shadow-lg flex items-center justify-center"
      >
        <i class="fas fa-search text-lg" id="searchIcon"></i>
        <svg id="loadingSpinner" class="hidden animate-spin h-5 w-5 text-[#3E3667]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
        </svg>
      </button>
    </form>
  </section>

  <script>
    document.getElementById("searchForm").addEventListener("submit", function (e) {
      e.preventDefault(); // mencegah submit langsung
    
      const btn = document.getElementById("searchBtn");
      const icon = document.getElementById("searchIcon");
      const spinner = document.getElementById("loadingSpinner");
    
      // Tampilkan spinner, sembunyikan icon
      icon.classList.add("hidden");
      spinner.classList.remove("hidden");
    
      // Simulasikan loading 2 detik (misalnya fetching data)
      setTimeout(() => {
        // Reset tampilan ke awal
        icon.classList.remove("hidden");
        spinner.classList.add("hidden");
    
        // Optional: kirim form di sini atau tampilkan hasil
        alert("nanti user diarahkan ke product yang available, tapi nanti yaa kita hubungi ke backend duluuu 😚💜");
      }, 2000);
    });
    </script> 
    
  
<!-- Flatpickr for calendar -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
// Inisialisasi #endDate sekali, simpan instance-nya
const endDatePicker = flatpickr("#endDate", {
  dateFormat: "Y-m-d",
  minDate: "today"
});

// Inisialisasi #startDate dan update batasan #endDate saat dipilih
flatpickr("#startDate", {
  dateFormat: "Y-m-d",
  minDate: "today",
  maxDate: new Date().fp_incr(7), // 7 hari dari hari ini
  onChange: function(selectedDates) {
    const startDate = selectedDates[0];
    if (!startDate) return;

    const maxEndDate = new Date(startDate);
    maxEndDate.setDate(startDate.getDate() + 7);

    // Update min & max date untuk #endDate
    endDatePicker.set("minDate", startDate);
    endDatePicker.set("maxDate", maxEndDate);
    endDatePicker.clear(); // Kosongkan value sebelumnya (jika ada)
  }
});
</script>
  <!-- Browse by Category -->
  <section id="category" class="max-w-7xl mx-auto mt-20 px-4 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold mb-8 text-center">
      Browse by Category
    </h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-4xl mx-auto">
      <a href="/electronic" class="block">
        <div class="bg-[#F8F1EE] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
          <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">
            ELECTRONIC
          </span>
        </div>
      </a>
      <a href="katalog_merch.html" class="block">
        <div class="bg-[#EBD7F0] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
          <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">
            MERCHANDISE
          </span>
        </div>
      </a>
      <a href="/others" class="block">
        <div class="bg-[#D9DFF7] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
          <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">
            OTHERS
          </span>
        </div>
      </a>
    </div>
  </section>
  
  <!-- Footer -->
  <footer class="bg-[#E9DFF7] mt-32 py-10">
   <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between text-[#3E3667] text-sm font-semibold px-4 sm:px-6 lg:px-8">
    <div class="border-r border-[#3E3667] pr-6 mb-6 sm:mb-0">
     <span>
      Copyright ©2025
     </span>
    </div>
    <div class="border-r border-[#3E3667] px-6 mb-6 sm:mb-0">
     <span class="text-3xl font-extrabold">
      Festify
     </span>
    </div>
    <div class="flex flex-col space-y-3 pl-6">
     <div class="flex items-center space-x-2">
      <i class="fab fa-instagram text-lg">
      </i>
      <span class="text-xs font-normal">
       @festifyrentalweb
      </span>
     </div>
     <div class="flex items-center space-x-2">
      <i class="fab fa-youtube text-lg">
      </i>
      <span class="text-xs font-normal">
       Festify Rental Web
      </span>
     </div>
    </div>
   </div>
  </footer>
 </body>
</html>