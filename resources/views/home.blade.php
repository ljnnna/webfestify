@extends('layouts.apphome')
@section('desktop-menu')
<div class="hidden lg:flex space-x-6 items-center">
    <a href="{{ route('home') }}"
        class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Home
    </a>
    <a href="{{ route('catalog') }}"
        class="{{ request()->routeIs('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Catalog
    </a>
    <a href="{{ route('team') }}"
        class="{{ request()->routeIs('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Team
    </a>
    <a href="{{ route('contact') }}"
        class="{{ request()->routeIs('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
        Contact
    </a>
</div>
@endsection
@section('content')
<!-- Hero with search bar -->
  <section class="relative max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <img
      alt="hero section"
      class="w-full rounded-lg shadow-lg"
      src="{{ asset('images/4.png') }}"
      width="1200"
      height="180"
    />
  
  <form id="searchForm"
  class="absolute bottom-16 left-1/2 transform -translate-x-1/2 w-[95%] sm:w-[90%] max-w-3xl
         bg-[#E9DFF7] bg-opacity-80 backdrop-blur-sm rounded-xl shadow-md
         flex flex-nowrap items-center overflow-x-auto divide-x divide-[#3E3667]
         text-[10px] sm:text-xs">

  <!-- Input Sections -->
  <div class="flex-1 min-w-[70px] px-2 sm:px-4 py-2 sm:py-3">
    <input
      type="text"
      name="product"
      placeholder="PRODUCT"
      class="w-full font-semibold text-[#3E3667] bg-transparent
             focus:outline-none placeholder:text-[#3E3667] border-b-2 border-transparent
             focus:border-[#3E3667] transition-all duration-200 text-[10px] sm:text-xs"
      required
    />
  </div>

  <div class="flex-1 min-w-[70px] px-2 sm:px-4 py-2 sm:py-3">
    <input
      type="text"
      id="startDate"
      name="start_date"
      placeholder="DAY START"
      class="w-full font-semibold text-[#3E3667] bg-transparent
             focus:outline-none placeholder:text-[#3E3667] border-b-2 border-transparent
             focus:border-[#3E3667] transition-all duration-200 text-[10px] sm:text-xs"
      required
    />
  </div>

  <div class="flex-1 min-w-[70px] px-2 sm:px-4 py-2 sm:py-3">
    <input
      type="text"
      id="endDate"
      name="end_date"
      placeholder="DAY END"
      class="w-full font-semibold text-[#3E3667] bg-transparent
             focus:outline-none placeholder:text-[#3E3667] border-b-2 border-transparent
             focus:border-[#3E3667] transition-all duration-200 text-[10px] sm:text-xs"
      required
    />
  </div>

  <!-- Button -->
  <button
    id="searchBtn"
    aria-label="Search"
    type="submit"
    class="flex-shrink-0 px-2 sm:px-4 py-2 sm:py-3 text-[#3E3667] hover:text-[#6B5DD3]
           transition-all duration-200 hover:shadow-lg flex items-center justify-center text-[12px] sm:text-sm"
  >
    <i class="fas fa-search text-sm sm:text-lg" id="searchIcon"></i>
    <svg id="loadingSpinner" class="hidden animate-spin h-4 w-4 sm:h-5 sm:w-5 text-[#3E3667]"
      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
      <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
      <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
    </svg>
  </button>
</form>

  </section>


{{-- Browse by Category --}}
<section id="category" class="max-w-7xl mx-auto mt-12 px-4 mb-12 sm:px-6 lg:px-8">
    <h2 class="text-3xl font-extrabold mb-8 text-center">Browse by Category</h2>
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-4xl mx-auto">
    <a href="{{ route('catalog.electronics') }}" class="block">
            <div class="bg-[#F8F1EE] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
                <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">ELECTRONIC</span>
            </div>
        </a>
        <a href="{{ route('catalog.merchandise') }}" class="block">
            <div class="bg-[#EBD7F0] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
                <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">MERCHANDISE</span>
            </div>
        </a>
        <a href="{{ route('catalog.merchandise') }}" class="block">

            <div class="bg-[#D9DFF7] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
                <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">OTHERS</span>
            </div>
        </a>
    </div>
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

    // Optional: tampilkan alert / redirect
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

<!-- VIDEO PRODUK -->
 <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
  <div class="relative aspect-w-16 aspect-h-9 overflow-hidden rounded-xl group">
    <video
      autoplay
      muted
      loop
      playsinline
      class="w-full h-full object-cover"
    >
      <source src="{{ asset('videos/samsung.mp4') }}" type="video/mp4">
      Your browser does not support the video tag.
    </video>

    <!-- Tombol muncul saat hover -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
      <a href="/admin/product/samsung-smartwatch"
         class="px-5 sm:px-6 py-2.5 sm:py-3 bg-pink-400/40 text-white font-semibold rounded-md transition duration-300 text-sm sm:text-base hover:bg-pink-700/80">
        View Product
      </a>
    </div>
  </div>
</section>


<!-- STRIP RENT NOW (Animated) -->
  <x-marquee-rent-now />

<!-- CATEGORY FILTER -->
<section class="mt-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <div id="categoryButtons" class="flex justify-center gap-4 flex-wrap">
    <button data-category="electronics" class="category-btn px-6 py-2 rounded-full bg-purple-200 text-purple-800 font-semibold shadow-md hover:bg-purple-300 transition">ELECTRONIC</button>
    <button data-category="merchandise" class="category-btn px-6 py-2 rounded-full bg-gray-100 text-gray-500 font-semibold shadow-md hover:bg-gray-200 transition">MERCHANDISE</button>
    <button data-category="others" class="category-btn px-6 py-2 rounded-full bg-gray-100 text-gray-500 font-semibold shadow-md hover:bg-gray-200 transition">OTHERS</button>
  </div>

  <!-- Swiper -->
  <div class="swiper mySwiper mt-8 pb-8">
    <div class="swiper-wrapper" id="productWrapper">
      <!-- Slide produk akan diinject di sini -->
    </div>
    <!-- Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <!-- Pagination -->
    <div class="swiper-pagination"></div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<script>
  const products = @json($products);
  const wrapper = document.getElementById("productWrapper");
  let swiper; // Buat variabel global

  function renderProducts(category) {
  if (swiper) {
    swiper.destroy(true, true);
  }

  wrapper.innerHTML = "";

  let filtered;
  if (category === 'others') {
  filtered = products.filter(product =>
    ['electronics', 'merchandise'].includes(product.category.name.toLowerCase())
  );
  } else {
  filtered = products.filter(product =>
    product.category.name.toLowerCase() === category.toLowerCase()
  );
  }

  if (filtered.length === 0) {
    wrapper.innerHTML = `
      <div class="swiper-slide">
        <div class="bg-white rounded-lg shadow-md p-6 text-center">
          <p class="text-gray-500">No products available in this category.</p>
        </div>
      </div>
    `;
  } else {
    filtered.forEach(product => {
      const slide = document.createElement("div");
      slide.className = "swiper-slide";
      slide.innerHTML = `
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <img src="/storage/${product.image}" alt="${product.name}" class="w-full h-40 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-semibold">${product.name}</h3>
          </div>
        </div>
      `;
      wrapper.appendChild(slide);
    });
  }

  swiper = new Swiper(".mySwiper", {
    slidesPerView: 3,
    spaceBetween: 30,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev"
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    }
  });
}


  // Tampilkan default kategori pertama (misalnya electronic)
  document.addEventListener('DOMContentLoaded', () => {
  const buttons = document.querySelectorAll(".category-btn");

  function updateActiveButton(selectedCategory) {
    buttons.forEach(btn => {
      const category = btn.getAttribute("data-category");
      if (category === selectedCategory) {
        btn.classList.remove("bg-gray-100", "text-gray-500");
        btn.classList.add("bg-purple-200", "text-purple-800");
      } else {
        btn.classList.remove("bg-purple-200", "text-purple-800");
        btn.classList.add("bg-gray-100", "text-gray-500");
      }
    });
  }

  // Set default
  const defaultCategory = 'electronics';
  renderProducts(defaultCategory);
  updateActiveButton(defaultCategory);

  // Event handler untuk semua tombol
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      const selected = btn.getAttribute("data-category");
      renderProducts(selected);
      updateActiveButton(selected);
    });
  });
});

</script>


<x-marquee-rent-now />
   
@endsection