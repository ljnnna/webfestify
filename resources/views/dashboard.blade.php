@extends('layouts.apphome')

@section('content')
    <!-- Hero with search bar -->
  <section class="relative max-w-7xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">
    <img
      alt="gambar hero"
      class="w-full rounded-lg shadow-lg"
      src="{{ asset('images/hero1.png') }}"
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

<<<<<<< HEAD
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
=======
            <!-- SEARCH BUTTON -->
            <button id="searchBtn" aria-label="Search" type="submit" class="flex-shrink-0 px-4 py-3 text-[#3E3667] hover:text-[#6B5DD3] transition-all duration-200 hover:shadow-lg flex items-center justify-center">
                <i class="fas fa-search text-lg" id="searchIcon"></i>
                <svg id="loadingSpinner" class="hidden animate-spin h-5 w-5 text-[#3E3667]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </button>
        </form>
    </section>

    {{-- Calendar logic --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                alert("nanti user diarahkan ke product yang available, tapi nanti yaa kita hubungi ke backend duluuu 😚💜");
            }, 2000);
        });

        const endDatePicker = flatpickr("#endDate", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });

        flatpickr("#startDate", {
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(30), // Ubah dari 7 ke 30 hari
            onChange: function (selectedDates) {
                const startDate = selectedDates[0];
                if (!startDate) return;

                const maxEndDate = new Date(startDate);
                maxEndDate.setDate(startDate.getDate() + 30); // Ubah dari 7 ke 30 hari

                endDatePicker.set("minDate", startDate);
                endDatePicker.set("maxDate", maxEndDate);
                endDatePicker.clear();
            }
        });
    </script>


    {{-- Browse by Category --}}
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
>>>>>>> d25387a1b739058cbb3054e2e6f0e7f45d3bcdd2
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
@endsection