<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Our Team</title>

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Flowbite CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

  <!-- AOS (Animate On Scroll) -->
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet" />

  <!-- Feather Icons -->
  <script src="https://unpkg.com/feather-icons"></script>
</head>
<body class="bg-gradient-to-b from-purple-100 via-pink-100 to-pink-200">

<section class="max-w-6xl mx-auto px-4 py-16 space-y-20">
  <!-- Judul -->
  <h1 class="text-4xl md:text-5xl font-bold text-center text-purple-800 mb-10" data-aos="fade-down">
    Our Team
  </h1>

  <!-- Anggota 1 -->
  <div class="flex flex-col md:flex-row items-center gap-6" data-aos="fade-right">
    <img src="{{ asset ('images/nania.png') }}" alt="Raka Wijaya"
         class="w-48 h-48 rounded-full object-cover shadow-xl">
    <div class="bg-white rounded-3xl p-6 shadow-md w-full md:w-[75%]">
      <h2 class="text-2xl font-bold text-purple-700">Nania Maharany</h2>
      <p class="text-gray-600 mt-2">Leader of the team. Works in the backend admin display section, compiling databases and projects reports.</p>
      <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
        <div class="flex items-center gap-2">
          <i data-feather="mail"></i>
          <span>raka.wijaya@email.com</span>
        </div>
        <div class="flex items-center gap-2 text-blue-500">
          <i data-feather="instagram"></i>
          <a href="#">@rakawijaya</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Anggota 2 -->
  <div class="flex flex-col md:flex-row-reverse items-center gap-6" data-aos="fade-left">
    <img src="{{ asset ('images/elsa.png') }}" alt="Ayu Lestari"
         class="w-48 h-48 rounded-full object-cover shadow-xl">
    <div class="bg-white rounded-3xl p-6 shadow-md w-full md:w-[75%] text-right">
      <h2 class="text-2xl font-bold text-purple-700">Elsa Veronika Munthe</h2>
      <p class="text-gray-600 mt-2">In charge of the frontend, designing UI/UX displays and compiling project reports.</p>
      <div class="mt-4 flex justify-end items-center gap-4 text-sm text-gray-500">
        <div class="flex items-center gap-2">
          <i data-feather="mail"></i>
          <span>ayu.lestari@email.com</span>
        </div>
        <div class="flex items-center gap-2 text-blue-500">
          <i data-feather="instagram"></i>
          <a href="#">@ayulestari</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Anggota 3 -->
  <div class="flex flex-col md:flex-row items-center gap-6" data-aos="fade-right">
    <img src="{{ asset ('images/theo.png') }}" alt="Dimas Pratama"
         class="w-48 h-48 rounded-full object-cover shadow-xl">
    <div class="bg-white rounded-3xl p-6 shadow-md w-full md:w-[75%]">
      <h2 class="text-2xl font-bold text-purple-700">Theo Febrian Setiawan</h2>
      <p class="text-gray-600 mt-2">Works in the backend admin display section, compiling databases and projects reports.</p>
      <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
        <div class="flex items-center gap-2">
          <i data-feather="mail"></i>
          <span>dimas.pratama@email.com</span>
        </div>
        <div class="flex items-center gap-2 text-blue-500">
          <i data-feather="instagram"></i>
          <a href="#">@dimaspratama</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Anggota 4 -->
  <div class="flex flex-col md:flex-row-reverse items-center gap-6" data-aos="fade-left">
    <img src="{{ asset ('images/sabeth.png') }}" alt="Siti Nurhaliza"
         class="w-48 h-48 rounded-full object-cover shadow-xl">
    <div class="bg-white rounded-3xl p-6 shadow-md w-full md:w-[75%] text-right">
      <h2 class="text-2xl font-bold text-purple-700">Elisabeth Margaretta</h2>
      <p class="text-gray-600 mt-2">In charge of the frontend, designing UI/UX displays and compiling project reports.
</p>
      <div class="mt-4 flex justify-end items-center gap-4 text-sm text-gray-500">
        <div class="flex items-center gap-2">
          <i data-feather="mail"></i>
          <span>siti.nurhaliza@email.com</span>
        </div>
        <div class="flex items-center gap-2 text-blue-500">
          <i data-feather="instagram"></i>
          <a href="#">@sitinurhaliza</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Anggota 5 -->
  <div class="flex flex-col md:flex-row items-center gap-6" data-aos="fade-right">
    <img src="{{ asset ('images/salsa.png') }}" alt="Fajar Nugroho"
         class="w-48 h-48 rounded-full object-cover shadow-xl">
    <div class="bg-white rounded-3xl p-6 shadow-md w-full md:w-[75%]">
      <h2 class="text-2xl font-bold text-purple-700">Salsabila</h2>
      <p class="text-gray-600 mt-2">In charge of the frontend, designing UI/UX displays and compiling project reports.</p>
      <div class="mt-4 flex items-center gap-4 text-sm text-gray-500">
        <div class="flex items-center gap-2">
          <i data-feather="mail"></i>
          <span>fajar.nugroho@email.com</span>
        </div>
        <div class="flex items-center gap-2 text-blue-500">
          <i data-feather="instagram"></i>
          <a href="#">@fajarnugroho</a>
        </div>
      </div>
    </div>
  </div>

</section>

<!-- Flowbite JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

<!-- AOS JS -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({ duration: 1000, once: true });
  feather.replace(); // Feather icon aktif
</script>
</body>
</html>
