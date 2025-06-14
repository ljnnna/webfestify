<!-- CATEGORY FILTER -->
<div class="container bg-white mx-auto px-4 sm:px-6 lg:px-8 mt-8 mb-8 py-8 rounded-2xl shadow-sm">

  <section>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">

      <!-- SHOW ALL -->
      <button data-category="others" class="category-btn flex items-center bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-left w-full">
        <img src="{{ asset('images/kursi.jpeg') }}" alt="Others" class="w-16 h-16 object-contain mr-4">
        <div>
          <h3 class="text-md font-semibold text-gray-900">Show All</h3>
          <p class="text-sm text-gray-500">Electronic, Marchandise & more</p>
        </div>
      </button>

      <!-- ELECTRONIC -->
      <button data-category="electronics" class="category-btn flex items-center bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-left w-full">
        <img src="{{ asset('images/s24ultra.png') }}" alt="Electronic" class="w-16 h-16 object-contain mr-4">
        <div>
          <h3 class="text-md font-semibold text-gray-900">Electronic</h3>
          <p class="text-sm text-gray-500">Lightstick & more</p>
        </div>
      </button>

      <!-- MERCHANDISE -->
      <button data-category="merchandise" class="category-btn flex items-center bg-white rounded-xl shadow-sm hover:shadow-md transition p-4 text-left w-full">
        <img src="{{ asset('images/accecoriescute.jpg') }}" alt="Merchandise" class="w-16 h-16 object-contain mr-4">
        <div>
          <h3 class="text-md font-semibold text-gray-900">Merchandise</h3>
          <p class="text-sm text-gray-500">T-shirt, pin & more</p>
        </div>
      </button>

    </div>
  </section>
</div>
