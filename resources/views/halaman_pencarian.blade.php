<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Festify Camera Rental</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">

  <!-- Navbar -->
  <!-- <nav class="bg-white shadow-md px-8 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-4">
      <img src="logo.png" alt="Festify" class="h-8">
      <a href="#" class="text-sm font-semibold text-gray-700 hover:text-purple-600">HOME</a>
      <a href="#" class="text-sm font-semibold text-gray-700 hover:text-purple-600">PRODUCT</a>
      <a href="#" class="text-sm font-semibold text-gray-700 hover:text-purple-600">ABOUT US</a>
      <a href="#" class="text-sm font-semibold text-gray-700 hover:text-purple-600">CONTACT</a>
    </div>
    <div class="flex items-center space-x-4">
      <input type="text" id="search" placeholder="Kamera" class="border rounded-full px-4 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400">
      <button class="text-gray-600">
        🛒
      </button>
      <button class="text-gray-600">
        👤
      </button>
    </div>
  </nav> -->

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-6 py-10 grid md:grid-cols-4 gap-8">
    
    <!-- Sidebar -->
    <div class="bg-gradient-to-b from-purple-200 to-blue-100 p-6 rounded-lg shadow-md self-start">
      <h2 class="text-xl font-bold text-purple-800 mb-4">Find your favorite camera!!</h2>
      <p class="text-gray-600 text-sm">"Experience every concert moment through the perfect lens."</p>
    </div>

    <!-- Product Cards -->
    <div class="md:col-span-3 grid grid-cols-1 md:grid-cols-3 gap-6">
      
      <!-- Card -->
      <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
        <img src="https://dummyimage.com/300x200/000/fff&text=DSLR" alt="Kamera DSLR" class="w-full rounded mb-4">
        <h3 class="font-semibold text-gray-700">Kamera DSLR hitam dengan lensa zoom besar</h3>
        <p class="text-purple-600 font-bold mt-2">Rp. 50.000/day</p>
        <a href="#" class="text-blue-500 text-sm mt-2 inline-block">Detail</a>
      </div>

      <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
        <img src="https://dummyimage.com/300x200/555/fff&text=Fujifilm+X100" alt="Fujifilm X100" class="w-full rounded mb-4">
        <h3 class="font-semibold text-gray-700">Fujifilm X100 retro hijau dengan sentuhan klasik digital</h3>
        <p class="text-purple-600 font-bold mt-2">Rp. 50.000/day</p>
        <a href="#" class="text-blue-500 text-sm mt-2 inline-block">Detail</a>
      </div>

      <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
        <img src="https://dummyimage.com/300x200/888/fff&text=Sony+Mirrorless" alt="Sony Mirrorless" class="w-full rounded mb-4">
        <h3 class="font-semibold text-gray-700">Sony mirrorless silver ramping dengan kualitas gambar tinggi</h3>
        <p class="text-purple-600 font-bold mt-2">Rp. 50.000/day</p>
        <a href="#" class="text-blue-500 text-sm mt-2 inline-block">Detail</a>
      </div>

      <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
        <img src="https://dummyimage.com/300x200/fab/fff&text=Instax" alt="Fujifilm Instax" class="w-full rounded mb-4">
        <h3 class="font-semibold text-gray-700">Fujifilm Instax mini pastel untuk cetak foto instan</h3>
        <p class="text-purple-600 font-bold mt-2">Rp. 50.000/day</p>
        <a href="#" class="text-blue-500 text-sm mt-2 inline-block">Detail</a>
      </div>

      <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
        <img src="https://dummyimage.com/300x200/f8c/fff&text=Canon+Pink" alt="Canon Pink" class="w-full rounded mb-4">
        <h3 class="font-semibold text-gray-700">Canon IXUS pink compact cocok selfie dan traveling ringan</h3>
        <p class="text-purple-600 font-bold mt-2">Rp. 50.000/day</p>
        <a href="#" class="text-blue-500 text-sm mt-2 inline-block">Detail</a>
      </div>

      <div class="bg-white p-4 rounded-lg shadow hover:shadow-lg">
        <img src="https://dummyimage.com/300x200/ccc/000&text=Olympus" alt="Olympus OM-D" class="w-full rounded mb-4">
        <h3 class="font-semibold text-gray-700">Olympus OM-D retro silver dengan lensa tajam jernih</h3>
        <p class="text-purple-600 font-bold mt-2">Rp. 50.000/day</p>
        <a href="#" class="text-blue-500 text-sm mt-2 inline-block">Detail</a>
      </div>

    </div>
  </div>

  <!-- Optional JS: search functionality (simple) -->
  <script>
    const searchInput = document.getElementById('search');

    searchInput.addEventListener('input', function(e) {
      const keyword = e.target.value.toLowerCase();
      const cards = document.querySelectorAll('.grid > div');

      cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        if (text.includes(keyword)) {
          card.style.display = "block";
        } else {
          card.style.display = "none";
        }
      });
    });
  </script>

</body>
</html>
