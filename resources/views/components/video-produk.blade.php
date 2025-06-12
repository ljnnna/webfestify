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
    <div class="mb-8 absolute bottom-4 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
      <a href="/admin/product/samsung-smartwatch"
         class="px-5 sm:px-6 py-2.5 sm:py-3 bg-pink-400/40 text-white font-semibold rounded-md transition duration-300 text-sm sm:text-base hover:bg-pink-700/80">
        View Product
      </a>
    </div>
  </div>
</section>