@extends('layouts.apphome')

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
        <a href="/electronic" class="block">
            <div class="bg-[#F8F1EE] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
                <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">ELECTRONIC</span>
            </div>
        </a>
        <a href="katalog_merch.html" class="block">
            <div class="bg-[#EBD7F0] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
                <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">MERCHANDISE</span>
            </div>
        </a>
        <a href="/others" class="block">
            <div class="bg-[#D9DFF7] rounded-xl shadow-md flex items-center justify-center h-40 transform hover:scale-105 transition duration-300 cursor-pointer">
                <span class="text-[#BDB9B9] font-extrabold text-lg tracking-wide">OTHERS</span>
            </div>
        </a>
    </div>
</section>


{{-- JS Section --}}
<script>
document.getElementById("searchForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const btn = document.getElementById("searchBtn");
    const icon = document.getElementById("searchIcon");
    const spinner = document.getElementById("loadingSpinner");

    icon.classList.add("hidden");
    spinner.classList.remove("hidden");

    setTimeout(() => {
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
    <button data-category="electronic" class="category-btn px-6 py-2 rounded-full bg-purple-200 text-purple-800 font-semibold shadow-md hover:bg-purple-300 transition">ELECTRONIC</button>
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
  const products = [
  // Electronic
  { id: 1, category: 'electronic', name: 'Camera', image: 'https://i.pinimg.com/736x/63/1b/d0/631bd012adae4d48adf12703a34469ef.jpg' },
  { id: 2, category: 'electronic', name: 'Camera', image: 'https://i.pinimg.com/736x/f2/b9/e6/f2b9e69e8c6abce96937d1d8822a3edf.jpg' },
  { id: 3, category: 'electronic', name: 'Camera', image: 'https://i.pinimg.com/736x/ef/9e/9a/ef9e9aa2740c268605c2d6742d2bd913.jpg' },
  { id: 4, category: 'electronic', name: 'Bluetooth Speaker', image: 'https://i.pinimg.com/736x/63/1b/d0/631bd012adae4d48adf12703a34469ef.jpg' },
  { id: 5, category: 'electronic', name: 'Gaming Laptop', image: 'https://i.pinimg.com/736x/f2/b9/e6/f2b9e69e8c6abce96937d1d8822a3edf.jpg' },
  { id: 6, category: 'electronic', name: 'Tablet Z', image: 'https://i.pinimg.com/736x/ef/9e/9a/ef9e9aa2740c268605c2d6742d2bd913.jpg' },
  { id: 7, category: 'electronic', name: 'Drone Cam', image: 'https://i.pinimg.com/736x/63/1b/d0/631bd012adae4d48adf12703a34469ef.jpg' },
  { id: 8, category: 'electronic', name: 'VR Headset', image: 'https://i.pinimg.com/736x/f2/b9/e6/f2b9e69e8c6abce96937d1d8822a3edf.jpg' },
  { id: 9, category: 'electronic', name: 'Portable Charger', image: 'https://i.pinimg.com/736x/ef/9e/9a/ef9e9aa2740c268605c2d6742d2bd913.jpg' },
  { id: 10, category: 'electronic', name: 'Smart Home Hub', image: 'https://i.pinimg.com/736x/63/1b/d0/631bd012adae4d48adf12703a34469ef.jpg' },

  // Merchandise
  { id: 11, category: 'merchandise', name: 'Light Stick ENHYPEN', image: 'https://i.pinimg.com/736x/c9/6c/b0/c96cb027dd24b26a451e2d539b25625b.jpg' },
  { id: 12, category: 'merchandise', name: 'Light Stick NCT', image: 'https://i.pinimg.com/736x/b1/c8/5b/b1c85b363d7df2e88de830e8db55db13.jpg' },
  { id: 13, category: 'merchandise', name: 'Light Stick EXO', image: 'https://i.pinimg.com/736x/59/35/1c/59351c5b9f50e7ff20f6315e9083a693.jpg' },
  { id: 14, category: 'merchandise', name: 'Light Stick BTS', image: 'https://i.pinimg.com/736x/b5/64/4c/b5644c35ed78df5d161acaeb9dac8c1f.jpg' },
  { id: 15, category: 'merchandise', name: 'Light Stick Black Pink', image: 'https://i.pinimg.com/736x/f0/37/70/f03770d4b0fe0b6545f793e83d44826c.jpg' },
  { id: 16, category: 'merchandise', name: 'Hoodie Brand', image: 'https://i.pinimg.com/736x/b3/64/2a/b3642ab1e61230d36008dcb23009929b.jpg' },
  { id: 17, category: 'merchandise', name: 'Phone Case', image: 'https://i.pinimg.com/736x/13/ab/b5/13abb53167f0453c5190be0a215e9919.jpg' },

  // Others
  { id: 21, category: 'others', name: 'Cap Logo', image: 'https://i.pinimg.com/736x/a2/28/b5/a228b568c8eefba087d13784dd8f142d.jpg' },
  { id: 22, category: 'others', name: 'Keychain', image: 'https://i.pinimg.com/736x/ae/97/d3/ae97d3162709b6b5d2f2e232b1ebb313.jpg' },
  { id: 23, category: 'others', name: 'Poster Art', image: 'https://i.pinimg.com/736x/f2/6c/75/f26c753a4bf5b7920d4b8a64deed468d.jpg' },
  { id: 24, category: 'others', name: 'T-Shirt Logo', image: 'https://i.pinimg.com/736x/b8/89/00/b8890012e1f8bf02285252f71ae8576e.jpg' },
  { id: 25, category: 'others', name: 'Sticker Pack', image: 'https://i.pinimg.com/736x/34/05/d3/3405d32d84edc99a09a3d362d863310d.jpg' },
  { id: 26, category: 'others', name: 'Hoodie Brand', image: 'https://i.pinimg.com/736x/b3/64/2a/b3642ab1e61230d36008dcb23009929b.jpg' },
  { id: 27, category: 'others', name: 'Phone Case', image: 'https://i.pinimg.com/736x/13/ab/b5/13abb53167f0453c5190be0a215e9919.jpg' },
  { id: 28, category: 'others', name: 'Water Bottle', image: 'https://i.pinimg.com/736x/bf/77/16/bf77167d03a574b1710d3e11e69cb88a.jpg' },
  { id: 29, category: 'others', name: 'Socks', image: 'https://i.pinimg.com/736x/2b/9a/c3/2b9ac369ba94df5a443048319abcfa87.jpg' },
  { id: 30, category: 'others', name: 'Backpack', image: 'https://i.pinimg.com/736x/08/86/0e/08860e9a2a9f55bed8cfd9dd967a786e.jpg' },
];


  const buttons = document.querySelectorAll('.category-btn');
  const productWrapper = document.getElementById('productWrapper');
  let swiperInstance;

  function renderProducts(category) {
    // Filter produk sesuai kategori
    const filtered = products.filter(p => p.category === category);
    productWrapper.innerHTML = ''; // Bersihkan dulu

    if (filtered.length === 0) {
      productWrapper.innerHTML = `
        <div class="swiper-slide flex items-center justify-center w-full text-gray-500">
          No products found for "${category.toUpperCase()}"
        </div>`;
      if(swiperInstance) swiperInstance.update();
      return;
    }

    filtered.forEach(product => {
      const slide = document.createElement('div');
      slide.className = 'swiper-slide bg-white rounded-lg shadow-md p-4 flex flex-col items-center';
      slide.innerHTML = `
        <img src="${product.image}" alt="${product.name}" class="w-40 h-40 object-cover rounded-md mb-3" />
        <h3 class="text-center font-semibold text-gray-800">${product.name}</h3>
      `;
      productWrapper.appendChild(slide);
    });

    // Update Swiper setelah isi slide berubah
    if(swiperInstance) {
      swiperInstance.update();
      swiperInstance.slideTo(0); // Reset slide ke awal
    }
  }

  // Init Swiper
  function initSwiper() {
    swiperInstance = new Swiper('.mySwiper', {
      slidesPerView: 3,
      spaceBetween: 20,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        }
      }
    });
  }

  // Event tombol kategori
  buttons.forEach(btn => {
    btn.addEventListener('click', () => {
      buttons.forEach(b => {
        b.classList.remove('bg-purple-200', 'text-purple-800');
        b.classList.add('bg-gray-100', 'text-gray-500');
      });

      btn.classList.remove('bg-gray-100', 'text-gray-500');
      btn.classList.add('bg-purple-200', 'text-purple-800');

      const selectedCategory = btn.getAttribute('data-category');
      renderProducts(selectedCategory);
    });
  });

  // Inisialisasi saat DOM siap
  window.addEventListener('DOMContentLoaded', () => {
    initSwiper();
    renderProducts('electronic');
  });
</script>

<x-marquee-rent-now />
   
@endsection