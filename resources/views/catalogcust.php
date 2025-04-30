<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Catalog Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap"
      rel="stylesheet"
    />
    <style>
      body {
        font-family: "Inter", sans-serif;
      }
    </style>
  </head>
  <body class="bg-white">
    <!-- Navbar -->
    <nav
      class="shadow-md shadow-[#D9C9F9] flex items-center justify-between px-4 sm:px-6 md:px-10 py-4"
      style="background: linear-gradient(to right, #eae1f9, #f5edfb)"
    >
      <div class="flex items-center space-x-6">
        <img
          alt="Festify"
          class="h-10 w-auto"
          height="40"
          src="images/logofestify.png"
          width="100"
        />
        <ul
          class="hidden md:flex space-x-8 text-[#493862] font-semibold text-base"
        >
          <li>
            <a class="hover:underline" href="#"> HOME </a>
          </li>
          <li>
            <a class="hover:underline" href="#"> PRODUCT </a>
          </li>
          <li>
            <a class="hover:underline" href="#"> ABOUT US </a>
          </li>
          <li>
            <a class="hover:underline" href="#"> CONTACT </a>
          </li>
        </ul>
      </div>
      <div class="flex items-center space-x-6">
        <div class="relative w-64 hidden md:block">
          <input
            class="w-full rounded-full py-2 pl-4 pr-10 text-sm text-[#493862] font-normal shadow-[0_4px_10px_rgba(0,0,0,0.1)] focus:outline-none"
            placeholder="Search"
            type="search"
          />
          <button
            aria-label="Search"
            class="absolute right-3 top-1/2 -translate-y-1/2 text-[#3B2F5C]"
          >
            <i class="fas fa-search"> </i>
          </button>
        </div>
        <button aria-label="Shopping cart" class="text-[#3B2F5C] text-xl">
          <i class="fas fa-shopping-cart"> </i>
        </button>
        <button
          aria-label="User account"
          class="bg-white rounded-full p-2 text-[#3B2F5C] text-xl"
        >
          <i class="fas fa-user"> </i>
        </button>
      </div>
    </nav>
    <main
      class="flex flex-col md:flex-row gap-8 px-4 sm:px-6 md:px-10 py-10 max-w-[1280px] mx-auto"
    >
      <!-- Filter Sidebar -->
      <aside
        class="bg-gradient-to-b from-[#FDE9FF] to-[#E6E9FF] rounded-xl p-6 w-full max-w-sm shadow-md shadow-[#D9C9F9]"
      >
        <h2
          class="text-[#34006C] font-semibold text-2xl mb-4 border-b border-[#3B2F5C] pb-2"
        >
          Filter
        </h2>
        <section class="mb-8">
          <h3 class="text-[#34006C] font-semibold mb-3">Category</h3>
          <form class="space-y-3 text-[#493862] text-sm font-normal">
            <label class="flex items-center space-x-2">
              <input class="accent-[#493862]" name="category" type="radio" />
              <span> Electronics </span>
            </label>
            <label class="flex items-center space-x-2">
              <input
                checked=""
                class="accent-[#493862]"
                name="category"
                type="radio"
              />
              <span> Merchandise </span>
            </label>
          </form>
        </section>
        <section class="mb-6">
          <h3 class="text-[#34006C] font-semibold mb-3">Price</h3>
          <input
            class="w-full accent-[#6B5B8A]"
            max="500000"
            min="0"
            type="range"
            value="250000"
          />
          <p class="text-xs text-[#493862] mt-1">0 - 500000</p>
        </section>
        <button
          class="w-full bg-[#6D5983] text-white font-bold py-3 rounded-lg hover:bg-[#5a4a75] transition"
        >
          RESET
        </button>
      </aside>

      <!-- Product Grid -->
      <section
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1"
      >
        <!-- Repeat 6 product cards -->
        <article
          class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center"
        >
          <img
            alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle"
            class="rounded-xl mb-4 w-full max-w-[250px] object-cover"
            height="250"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
            width="250"
          />
          <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
            Lightstick Seventeen
          </h3>
          <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
          <a
            href="details_product_catalog_customer.html"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center"
          >
            Details
          </a>
        </article>
        <article
          class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center"
        >
          <img
            alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle"
            class="rounded-xl mb-4 w-full max-w-[250px] object-cover"
            height="250"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
            width="250"
          />
          <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
            Lightstick Seventeen
          </h3>
          <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
          <a
            href="details_product_catalog_customer.html"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center"
          >
            Details
          </a>
        </article>
        <article
          class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center"
        >
          <img
            alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle"
            class="rounded-xl mb-4 w-full max-w-[250px] object-cover"
            height="250"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
            width="250"
          />
          <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
            Lightstick Seventeen
          </h3>
          <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
          <a
            href="details_product_catalog_customer.html"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center"
          >
            Details
          </a>
        </article>
        <article
          class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center"
        >
          <img
            alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle"
            class="rounded-xl mb-4 w-full max-w-[250px] object-cover"
            height="250"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
            width="250"
          />
          <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
            Lightstick Seventeen
          </h3>
          <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
          <a
            href="details_product_catalog_customer.html"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center"
          >
            Details
          </a>
        </article>
        <article
          class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center"
        >
          <img
            alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle"
            class="rounded-xl mb-4 w-full max-w-[250px] object-cover"
            height="250"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
            width="250"
          />
          <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
            Lightstick Seventeen
          </h3>
          <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
          <a
            href="details_product_catalog_customer.html"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center"
          >
            Details
          </a>
        </article>
        <article
          class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center"
        >
          <img
            alt="Lightstick Seventeen product image held in hand with diamond shape top and silver metal handle"
            class="rounded-xl mb-4 w-full max-w-[250px] object-cover"
            height="250"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
            width="250"
          />
          <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
            Lightstick Seventeen
          </h3>
          <p class="text-[#493862] text-xs w-full mb-4">Rp250.000/day</p>
          <a
            href="details_product_catalog_customer.html"
            class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center"
          >
            Details
          </a>
        </article>
      </section>
    </main>
  </body>
</html>
