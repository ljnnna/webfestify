<x-layouts.learnmore title="Panduan Penggunaan">
  <div class="max-w-3xl mx-auto bg-[#fdf5ff]/60 backdrop-blur-md rounded-3xl shadow-xl p-6 sm:p-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-center text-[#cba0ff] mb-6 sm:mb-8">
      How to use the application
    </h1>

    <div class="space-y-6">
      <x-step icon="https://cdn-icons-png.flaticon.com/512/16130/16130809.png"
              title="1. Daftar atau Login"
              description="Klik tombol login di pojok kanan atas dan masukkan data kamu. Jika belum punya akun, klik ‘Daftar’." />

      <x-step icon="https://cdn-icons-png.flaticon.com/512/747/747545.png"
              title="2. Masuk ke Beranda"
              description="Setelah login, kamu akan diarahkan ke halaman utama yang menampilkan fitur-fitur." />

      <x-step icon="https://cdn-icons-png.flaticon.com/512/747/747376.png"
              title="3. Lengkapi Profil"
              description="Masuk ke menu ‘Profil Saya’ untuk melengkapi informasi dasar seperti nama, alamat, dan kontak."
              delay="delay-100" />

      <x-step icon="https://cdn-icons-png.flaticon.com/512/891/891419.png"
              title="4. Mulai Menggunakan Layanan"
              description="Pilih produk atau layanan yang kamu butuhkan dan ikuti alurnya sampai selesai. Semua cukup dengan klik!"
              delay="delay-200" />

      <x-step icon="https://cdn-icons-png.flaticon.com/512/1828/1828884.png"
              title="5. Riwayat & Bantuan"
              description="Cek status pemesananmu di ‘Riwayat’. Jika ada kendala, langsung ke ‘Pusat Bantuan’."
              delay="delay-300" />
    </div>

    <div class="mt-8 sm:mt-10 text-center">
      <a href="/home" class="text-white bg-[#b081f5] hover:bg-[#a26be0] font-semibold py-2 px-5 sm:px-6 rounded-full transition-all duration-300 shadow-md">
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
</x-layouts.learnmore>
