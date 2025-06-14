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
  <section class="relative max-w-7xl mx-auto mb-4 px-4 sm:px-6 lg:px-8">
    <img
      alt="hero section"
      class="w-full rounded-lg shadow"
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

{{-- MENAMPILKAN GAMBAR PADA HOMEPAGE --}}
@include('components.images-layout')

{{-- VIDEO PRODUK --}}
@include('components.video-produk')

<!-- STRIP RENT NOW (Animated) -->
<x-marquee-rent-now />

{{-- MEMANGGIL BUTTON CATEGORY --}}
@include('components.category-filter')

{{-- MENAMPILKAN PRODUK DARI DATABASE --}}
@include('components.product-home')
   
@endsection