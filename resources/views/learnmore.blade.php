<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cara Penggunaan Akun - Customer</title>

  <!-- Flowbite dan Tailwind -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

  <!-- Style custom -->
  <style>
    body {
      background: linear-gradient(135deg, #e0caff, #fbd0ff, #fde6ff);
      font-family: 'Segoe UI', sans-serif;
    }

    .step {
      animation: fadeSlideUp 0.8s ease forwards;
      opacity: 0;
      transform: translateY(20px);
    }

    @keyframes fadeSlideUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>

<body class="min-h-screen px-4 md:px-6 py-8 md:py-10 text-[#5a3a82]">
  <div class="max-w-3xl mx-auto bg-[#fdf5ff]/60 backdrop-blur-md rounded-3xl shadow-xl p-6 sm:p-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-center text-[#cba0ff] mb-6 sm:mb-8">
      How to use the application
    </h1>

    <div class="space-y-6">
      <!-- Step 1 -->
      <div class="step flex flex-col sm:flex-row items-start bg-white/30 rounded-xl p-4 sm:p-5 shadow-md">
        <img src="https://cdn-icons-png.flaticon.com/512/16130/16130809.png" alt="Login Icon" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-0 sm:mr-4" />
        <div>
          <h2 class="text-lg sm:text-xl font-semibold mb-1 sm:mb-2 text-[#b081f5]">1. Daftar atau Login</h2>
          <p class="text-sm sm:text-base">Klik tombol login di pojok kanan atas dan masukkan data kamu. Jika belum punya akun, klik “Daftar”.</p>
        </div> 
      </div>

      <!-- Step 1 -->
      <div class="step flex flex-col sm:flex-row items-start bg-white/30 rounded-xl p-4 sm:p-5 shadow-md">
        <img src="https://cdn-icons-png.flaticon.com/512/747/747545.png" alt="Login Icon" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-0 sm:mr-4" />
        <div>
          <h2 class="text-lg sm:text-xl font-semibold mb-1 sm:mb-2 text-[#b081f5]">1. Daftar atau Login</h2>
          <p class="text-sm sm:text-base">Klik tombol login di pojok kanan atas dan masukkan data kamu. Jika belum punya akun, klik “Daftar”.</p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="step flex flex-col sm:flex-row items-start bg-white/30 rounded-xl p-4 sm:p-5 shadow-md delay-100">
        <img src="https://cdn-icons-png.flaticon.com/512/747/747376.png" alt="Profile Icon" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-0 sm:mr-4" />
        <div>
          <h2 class="text-lg sm:text-xl font-semibold mb-1 sm:mb-2 text-[#b081f5]">2. Lengkapi Profil</h2>
          <p class="text-sm sm:text-base">Masuk ke menu “Profil Saya” untuk melengkapi informasi dasar seperti nama, alamat, dan kontak.</p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="step flex flex-col sm:flex-row items-start bg-white/30 rounded-xl p-4 sm:p-5 shadow-md delay-200">
        <img src="https://cdn-icons-png.flaticon.com/512/891/891419.png" alt="Service Icon" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-0 sm:mr-4" />
        <div>
          <h2 class="text-lg sm:text-xl font-semibold mb-1 sm:mb-2 text-[#b081f5]">3. Mulai Menggunakan Layanan</h2>
          <p class="text-sm sm:text-base">Pilih produk atau layanan yang kamu butuhkan dan ikuti alurnya sampai selesai. Semua cukup dengan klik!</p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="step flex flex-col sm:flex-row items-start bg-white/30 rounded-xl p-4 sm:p-5 shadow-md delay-300">
        <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png" alt="Help Icon" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-0 sm:mr-4" />
        <div>
          <h2 class="text-lg sm:text-xl font-semibold mb-1 sm:mb-2 text-[#b081f5]">4. Riwayat & Bantuan</h2>
          <p class="text-sm sm:text-base">Cek status pemesananmu di “Riwayat”. Jika ada kendala, langsung ke “Pusat Bantuan”.</p>
        </div>
      </div>
    </div>

    <div class="mt-8 sm:mt-10 text-center">
      <a href="{{ route('welcome') }}" class="text-white bg-[#b081f5] hover:bg-[#a26be0] font-semibold py-2 px-5 sm:px-6 rounded-full transition-all duration-300 shadow-md">
        Kembali ke Beranda
      </a>
    </div>
  </div>

  <script>
    const steps = document.querySelectorAll('.step');
    steps.forEach((el, index) => {
      el.style.animationDelay = `${index * 0.3}s`;
    });
  </script>
</body>
</html>
