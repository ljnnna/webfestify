<x-app-layout>
<!-- Contact Header -->
<header class="relative bg-white">
  <img src="https://i.pinimg.com/736x/c2/9a/d9/c29ad93c7ddc9a17cc6d591b7c7b01c3.jpg" alt="contact us" class="w-full h-[300px] object-cover object-center brightness-100" />
  <div class="absolute inset-0 flex flex-col justify-center items-center text-center px-4">
    <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-purple-900 to-blue-900 font-extrabold text-3xl sm:text-4xl md:text-5xl leading-tight">Contact Us</h1>
    <p class="text-white text-xs sm:text-sm md:text-base max-w-xl mt-2 leading-relaxed">
      Have a question, idea, or collaboration for Festify? Let's talk and bring your vibe to the festival!
    </p>
  </div>
</header>

<!-- Main Content Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <!-- Contact Content -->
  <main class="py-10">
    <div class="flex flex-col lg:flex-row gap-10">
      <!-- Contact Info -->
      <section class="lg:w-1/2">
        <h2 class="font-extrabold text-2xl text-purple-900 mb-2">Get In Touch</h2>
        <p class="text-gray-600 mb-8 max-w-md">Let us know your thoughts or collaborations!</p>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 gap-x-10 max-w-md">
          <!-- Contact items -->
          <div class="flex items-center gap-3">
            <div class="bg-gradient-to-r from-purple-900 to-blue-900 text-white p-3 rounded-md shadow-md"><i class="fas fa-phone-alt text-sm"></i></div>
            <div><p class="font-semibold">Phone</p><p class="text-sm text-gray-600">(+081) 5678 1234</p></div>
          </div>
          <div class="flex items-center gap-3">
            <div class="bg-gradient-to-r from-purple-900 to-blue-900 text-white p-3 rounded-md shadow-md"><i class="fas fa-envelope text-sm"></i></div>
            <div><p class="font-semibold">Email</p><p class="text-sm text-gray-600">email@festify.com</p></div>
          </div>
          <div class="flex items-center gap-3">
            <div class="bg-gradient-to-r from-purple-900 to-blue-900 text-white p-3 rounded-md shadow-md"><i class="fas fa-map-marker-alt text-sm"></i></div>
            <div><p class="font-semibold">Address</p><p class="text-sm text-gray-600">Festival Avenue, Jakarta</p></div>
          </div>
          <div class="flex items-center gap-3">
            <div class="bg-gradient-to-r from-purple-900 to-blue-900 text-white p-3 rounded-md shadow-md"><i class="fab fa-instagram text-sm"></i></div>
            <div><p class="font-semibold">Instagram</p><p class="text-sm text-gray-600">@festify.id</p></div>
          </div>
        </div>
        <div class="mt-8 text-xs text-gray-700 flex items-center gap-4">
          <span>Social Media</span>
          <a href="#" class="hover:text-purple-700 transition-colors duration-200"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="hover:text-purple-700 transition-colors duration-200"><i class="fab fa-twitter"></i></a>
          <a href="#" class="hover:text-purple-700 transition-colors duration-200"><i class="fab fa-youtube"></i></a>
        </div>
      </section>

      <!-- Contact Form -->
      <section class="lg:w-1/2 bg-purple-50 rounded-xl p-6 sm:p-8 shadow-md">
        <form class="space-y-4">
          <div class="flex gap-4">
            <div class="flex flex-col w-1/2">
              <label for="email" class="text-xs font-semibold mb-1">Email</label>
              <input type="email" id="email" class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="Email">
            </div>
            <div class="flex flex-col w-1/2">
              <label for="name" class="text-xs font-semibold mb-1">Name</label>
              <input type="text" id="name" class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="Name">
            </div>
          </div>
          <div class="flex flex-col">
            <label for="phone" class="text-xs font-semibold mb-1">Phone</label>
            <input type="tel" id="phone" class="rounded-md border px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-purple-400" placeholder="Phone">
          </div>
          <div class="flex flex-col">
            <label for="message" class="text-xs font-semibold mb-1">Message</label>
            <textarea id="message" class="rounded-md border px-3 py-2 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-purple-400" rows="4" placeholder="Message"></textarea>
          </div>
          <button type="submit" class="bg-purple-900 text-white text-xs font-semibold px-6 py-2 rounded-md hover:bg-purple-800">
            Send Message
          </button>
        </form>
      </section>
    </div>
  </main>

  <!-- Map Section -->
  <section class="pb-10">
    <h2 class="text-2xl font-extrabold text-purple-900 mb-4">Our Location</h2>
    <div class="w-full h-96 rounded-lg overflow-hidden shadow-lg">
      <iframe 
        class="w-full h-full"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d19802.682561153735!2d-0.12443277499806426!3d51.50332417440669!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487604bfacd8e46f%3A0x4572c7f7cc82d5c7!2sLondon%20Eye!5e0!3m2!1sen!2suk!4v1627912939857!5m2!1sen!2suk"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </section>
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

</script>
<script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.js"></script>
</x-app-layout>

