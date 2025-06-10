@extends('layouts.app')

@section('title', 'Home')

{{-- Desktop Menu --}}
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

{{-- Main Content --}}
@section('content')
  <!-- Contact Header -->
  <header class="relative bg-white">
    <img src="https://i.pinimg.com/736x/c2/9a/d9/c29ad93c7ddc9a17cc6d591b7c7b01c3.jpg" alt="contact us" class="w-full h-[300px] object-cover object-center brightness-100" />
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4">
      <h1 class="text-purple font-extrabold text-3xl sm:text-4xl md:text-5xl leading-tight">Contact Us</h1>
      <p class="text-white text-xs sm:text-sm md:text-base max-w-xl mt-2 leading-relaxed">
        Got a question, an idea, or just want to say hi? We’d love to hear your vibe! Reach out through the form or our contact info below.
      </p>
    </div>
  </header>

  <!-- Main Content Container -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <main class="py-10">
      <div class="flex flex-col lg:flex-row gap-10">
        <!-- Contact Info -->
        <section class="lg:w-1/2">
          <h2 class="font-extrabold text-2xl mb-2">Get In Touch</h2>
          <p class="text-gray-600 mb-8 max-w-md">We’d love to hear from you! Feel free to contact us via the form or through the details below.</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10 max-w-md">
            <div class="flex items-center gap-3">
              <div class="bg-purple-950 text-white p-3 rounded-md shadow-md"><i class="fas fa-phone-alt text-sm"></i></div>
              <div><p class="font-semibold">Phone</p><p class="text-sm text-gray-600">(+081) 5678 1234</p></div>
            </div>
            <div class="flex items-center gap-3">
              <div class="bg-purple-950 text-white p-3 rounded-md shadow-md"><i class="fas fa-envelope text-sm"></i></div>
              <div><p class="font-semibold">Email</p><p class="text-sm text-gray-600">festify2b@gmail.com</p></div>
            </div>
            <div class="flex items-center gap-3">
              <div class="bg-purple-950 text-white p-3 rounded-md shadow-md"><i class="fas fa-map-marker-alt text-sm"></i></div>
              <div><p class="font-semibold">Address</p><p class="text-sm text-gray-600">Politeknik Negeri Batam, Indonesia</p></div>
            </div>
            <div class="flex items-center gap-3">
              <div class="bg-purple-950 text-white p-3 rounded-md shadow-md"><i class="fab fa-instagram text-sm"></i></div>
              <div><p class="font-semibold">Instagram</p><p class="text-sm text-gray-600">@festifyyy</p></div>
            </div>
          </div>
          <div class="mt-8 text-xs text-gray-700 flex items-center gap-4">
            <span>Social Media</span>
            <a href="#" class="hover:text-blue-700"><i class="fab fa-facebook-f"></i></a>
            <a href="#" class="hover:text-blue-700"><i class="fab fa-twitter"></i></a>
            <a href="#" class="hover:text-blue-700"><i class="fab fa-youtube"></i></a>
          </div>
        </section>

        <!-- Contact Form -->
        <section class="lg:w-1/2 bg-purple-100 rounded-lg p-6 sm:p-8">
          <form class="space-y-4">
            <div class="flex gap-4">
              <div class="flex flex-col w-1/2">
                <label for="email" class="text-xs font-semibold mb-1">Email</label>
                <input type="email" id="email" class="rounded-md border px-3 py-2 text-sm" placeholder="Email">
              </div>
              <div class="flex flex-col w-1/2">
                <label for="name" class="text-xs font-semibold mb-1">Name</label>
                <input type="text" id="name" class="rounded-md border px-3 py-2 text-sm" placeholder="Name">
              </div>
            </div>
            <div class="flex flex-col">
              <label for="phone" class="text-xs font-semibold mb-1">Phone</label>
              <input type="tel" id="phone" class="rounded-md border px-3 py-2 text-sm" placeholder="Phone">
            </div>
            <div class="flex flex-col">
              <label for="message" class="text-xs font-semibold mb-1">Message</label>
              <textarea id="message" class="rounded-md border px-3 py-2 text-sm resize-none" rows="4" placeholder="Message"></textarea>
            </div>
            <button type="submit" class="bg-blue-900 text-white text-xs font-semibold px-6 py-2 rounded-md hover:bg-blue-800">
              Send Message
            </button>
          </form>
        </section>
      </div>

      <!-- Map Section -->
       <section class="pt-16">
         <h2 class="text-2xl font-extrabold mb-4">Our Location</h2>
         <div class="w-full h-96 rounded-lg overflow-hidden shadow-lg">
           <iframe 
             class="w-full h-full"
             src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3142.4218338316923!2d104.04587630924377!3d1.1187258622731475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98921856ddfab%3A0xf9d9fc65ca00c9d!2sPoliteknik%20Negeri%20Batam!5e1!3m2!1sen!2sid!4v1749528470313!5m2!1sen!2sid"
             allowfullscreen=""
             loading="lazy"
             referrerpolicy="no-referrer-when-downgrade">
           </iframe>
         </div>
       </section>
    </main>
  </div>

  <!-- Scripts -->
  <script>
    function openDrawer() {
      document.getElementById('mobile-drawer').classList.remove('-translate-x-full');
      document.getElementById('drawer-overlay').classList.remove('hidden');
    }

    function closeDrawer() {
      document.getElementById('mobile-drawer').classList.add('-translate-x-full');
      document.getElementById('drawer-overlay').classList.add('hidden');
    }

    function toggleDarkMode() {
      const html = document.documentElement;
      html.classList.toggle('dark');
      const icon = document.getElementById('theme-icon');
      icon.textContent = html.classList.contains('dark') ? '☀️' : '🌙';
    }
  </script>
  <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
@endsection

