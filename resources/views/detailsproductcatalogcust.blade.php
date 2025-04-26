<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1" name="viewport" />
  <title>Details Product Catalog Customer</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />

  <!-- Google Font: Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&amp;display=swap" rel="stylesheet" />

  <!-- Flatpickr Date Picker -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

  <!-- Custom Font -->
  <style>
    body {
      font-family: "Inter";
    }
  </style>
</head>

<body class="bg-white">
  <!-- ========== Navbar ========== -->
  <nav class="shadow-md shadow-[#D9C9F9] flex items-center justify-between px-4 sm:px-6 md:px-10 py-4"
    style="background: linear-gradient(to right, #eae1f9, #f5edfb)">
    <!-- Logo & Menu -->
    <div class="flex items-center space-x-6">
      <img alt="Festify" class="h-10 w-auto" height="40" src="image/logofestify.png" width="100" />
      <ul class="hidden md:flex space-x-8 text-[#493862] font-semibold text-base">
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

    <!-- Search, Cart, User -->
    <div class="flex items-center space-x-6">
      <div class="relative w-64 hidden md:block">
        <input
          class="w-full rounded-full py-2 pl-4 pr-10 text-sm text-[#493862] font-normal shadow-[0_4px_10px_rgba(0,0,0,0.1)] focus:outline-none"
          placeholder="Search" type="search" />
        <button aria-label="Search" class="absolute right-3 top-1/2 -translate-y-1/2 text-[#3B2F5C]">
          <i class="fas fa-search"> </i>
        </button>
      </div>
      <button aria-label="Shopping cart" class="text-[#3B2F5C] text-xl">
        <i class="fas fa-shopping-cart"> </i>
      </button>
      <button aria-label="User account" class="bg-white rounded-full p-2 text-[#3B2F5C] text-xl">
        <i class="fas fa-user"> </i>
      </button>
    </div>
  </nav>

  <!-- ========== Main Content ========== -->
  <main class="flex flex-col md:flex-row gap-8 px-4 sm:px-6 md:px-10 py-10 max-w-[1280px] mx-auto">

    <!-- Product Display -->
    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
      <!-- Product Images -->
      <div class="flex flex-col items-center space-y-6 lg:space-y-10">
        <div class="relative w-72 h-96">
          <img alt="BTS Lightstick with black box behind it, studio product photo" class="w-full h-full object-cover"
            height="384" src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg" width="288" />

          <!-- Navigasi Gambar -->
          <button id="prev-image-btn" aria-label="Previous image"
            class="absolute top-1/2 -left-10 -translate-y-1/2 bg-white rounded-md p-3 shadow cursor-pointer text-[#2E1B5F] text-xl"
            onclick="changeImage(-1)">
            <i class="fas fa-chevron-left"> </i>
          </button>
          <button id="next-image-btn" aria-label="Next image"
            class="absolute top-1/2 -right-10 -translate-y-1/2 bg-[#2E1B5F] rounded-md p-3 shadow cursor-pointer text-white text-xl"
            onclick="changeImage(1)">
            <i class="fas fa-chevron-right"> </i>
          </button>
        </div>

        <!-- Thumbnail -->
        <div class="flex space-x-6">
          <img alt="Thumbnail image of BTS Lightstick with black box behind it, studio product photo"
            class="thumbnail w-18 h-18 object-cover rounded-sm border-2 border-transparent cursor-pointer" height="72"
            src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg" width="72" />
          <img alt="Thumbnail image of BTS Lightstick side view with box, studio product photo"
            class="thumbnail w-18 h-18 object-cover rounded-sm border-2 border-transparent cursor-pointer" height="72"
            src="https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg" width="72" />
          <img alt="Thumbnail image of BTS Lightstick angled view with box, studio product photo"
            class="thumbnail w-18 h-18 object-cover rounded-sm border-2 border-transparent cursor-pointer" height="72"
            src="https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg" width="72" />
          <img alt="Thumbnail image of BTS Lightstick front view with box, studio product photo"
            class="thumbnail w-18 h-18 object-cover rounded-sm border-2 border-transparent cursor-pointer" height="72"
            src="https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain"
            width="72" />
        </div>
      </div>

      <!-- Informasi Produk -->
      <section class="flex-1 max-w-3xl">
        <h1 class="text-[#1A0041] font-extrabold text-3xl mb-1">
          Lightstick - BTS
        </h1>
        <p class="text-[#7F5CB2] text-xl mb-6">Rp.250.000/day</p>

        <!-- Pilih Versi -->
        <div class="mb-6">
          <h2 class="text-[#493862] font-bold text-lg mb-2">Version</h2>
          <div class="flex space-x-4" id="version-buttons">
            <button class="version-btn bg-[#EFD0EF] text-white font-semibold rounded-full px-6 py-2" data-version="1">
              1
            </button>
            <button class="version-btn border border-gray-300 text-[#8B7CC4] font-semibold rounded-full px-6 py-2"
              data-version="2">
              2
            </button>
            <button class="version-btn border border-gray-300 text-[#8B7CC4] font-semibold rounded-full px-6 py-2"
              data-version="3">
              3
            </button>
            <button class="version-btn border border-gray-300 text-[#8B7CC4] font-semibold rounded-full px-6 py-2"
              data-version="4">
              4
            </button>
          </div>
        </div>

        <!-- Jumlah & Aksi -->
        <div class="mb-6 flex items-center space-x-4">
          <div aria-label="Quantity selector"
            class="flex items-center border border-gray-300 rounded-full overflow-hidden w-36">
            <button aria-label="Decrease quantity"
              class="flex-1 py-2 text-2xl text-[#6D5983] font-semibold text-center focus:outline-none">
              -
            </button>
            <span class="w-10 text-center py-2 text-xl font-semibold text-[#6D5983]">
              2
            </span>
            <button aria-label="Increase quantity"
              class="flex-1 py-2 text-2xl text-[#6D5983] font-semibold text-center focus:outline-none">
              +
            </button>
          </div>
          <a href="cartpage.html" class="bg-[#6B549A] text-white rounded-full px-8 py-3 font-semibold text-lg">
            Add To Cart
          </a>

          <a href="payment_cust.html" class="bg-[#6B549A] text-white rounded-full px-8 py-3 font-semibold text-lg">
            Rent Now
          </a>
        </div>

        <!-- Tanggal Sewa -->
        <button id="select-date-btn" class="w-full bg-[#E6D9F7] text-[#8B7CC4] text-lg font-semibold rounded-full py-3"
          type="button">
          Select Rental Date
        </button>

        <!-- Datepicker Container -->
        <div id="datepicker-container" class="mt-4 hidden">
          <input id="rental-date"
            class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
            placeholder="Pilih tanggal penyewaan" />
        </div>

        <!-- Date Range Picker -->
        <div id="datepicker-wrapper" class="mt-6 space-y-4 hidden">
          <!-- Tanggal Mulai -->
          <div>
            <label for="start-date" class="block text-[#6D5983] font-semibold mb-1">Rental Start Date</label>
            <input id="start-date"
              class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
              placeholder="Select rental start date" />
          </div>

          <!-- Tanggal Selesai -->
          <div>
            <label for="end-date" class="block text-[#6D5983] font-semibold mb-1">Rental End Date</label>
            <input id="end-date"
              class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
              placeholder="Select rental end date" />
          </div>
        </div>

        <!-- Deskripsi & Detail -->
        <div class="mt-10 border-t border-gray-300 pt-6 flex space-x-20">
          <button id="description-btn" class="text-[#2E1B5F] font-extrabold text-2xl border-b-4 border-[#2E1B5F] pb-2"
            type="button">
            Description
          </button>
          <button id="details-btn" class="text-[#2E1B5F] font-extrabold text-2xl pb-2" type="button">
            Details
          </button>
        </div>
        <div id="description" class="content">
          <p class="mt-4 text-[#8B7CC4] font-semibold text-base max-w-3xl leading-relaxed">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
            enim ad minim veniam, quis nostrud exercitation ullamco laboris
            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
            reprehenderit in voluptate velit esse cillum dolore eu fugiat
            nulla pariatur.
          </p>
        </div>

        <div id="details" class="content hidden">
          <p class="mt-4 text-[#8B7CC4] font-semibold text-base max-w-3xl leading-relaxed">
            Here are the details about the product, including specifications,
            features, and other relevant information.
          </p>
        </div>
      </section>
    </div>
  </main>

  <!-- Customer Reviews -->
  <section class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded-xl p-6 shadow-md">
      <h2 class="text-left text-[#2E1B5F] font-extrabold text-2xl mb-6">
        Customer Reviews
      </h2>

      <div class="flex flex-col md:flex-row md:space-x-12">
        <div class="flex-1 bg-purple-100 rounded-lg p-6 mb-8 md:mb-0">
          <div class="flex flex-col items-center justify-center space-y-2 mb-2">
            <span class="text-4xl font-bold text-purple-700 mb-4">
              4.3
            </span>
            <div class="flex space-x-8 text-purple-700 text-lg">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star-half-alt"></i>
            </div>
          </div>
          <p class="text-center text-purple-700 font-semibold">
            55 Ratings
          </p>
        </div>
        <div class="flex-1">
          <div class="space-y-4 text-sm text-gray-600">
            <div class="flex items-center justify-between">
              <span>
                5.0
              </span>
              <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                <div class="h-2 bg-purple-700 rounded-full" style="width: 115px">
                </div>
              </div>
              <span>
                36
              </span>
            </div>
            <div class="flex items-center justify-between">
              <span>
                4.0
              </span>
              <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                <div class="h-2 bg-purple-700 rounded-full" style="width: 96px">
                </div>
              </div>
              <span>
                30
              </span>
            </div>
            <div class="flex items-center justify-between">
              <span>
                3.0
              </span>
              <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                <div class="h-2 bg-purple-700 rounded-full" style="width: 86px">
                </div>
              </div>
              <span>
                27
              </span>
            </div>
            <div class="flex items-center justify-between">
              <span>
                2.0
              </span>
              <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                <div class="h-2 bg-purple-700 rounded-full" style="width: 25px">
                </div>
              </div>
              <span>
                8
              </span>
            </div>
            <div class="flex items-center justify-between">
              <span>
                1.0
              </span>
              <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                <div class="h-2 bg-purple-700 rounded-full" style="width: 6px">
                </div>
              </div>
              <span>
                2
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h3 class="font-semibold text-gray-700 text-xl mb-4">
            Recent Feedbacks
          </h3>
          <div class="space-y-6">
            <div class="flex space-x-4">
              <img alt="Profile picture of Issac Cassanova, male with short hair"
                class="w-12 h-12 rounded-full object-cover" height="48"
                src="https://storage.googleapis.com/a1aa/image/492c70e4-3bc6-418a-eee2-8c681d605608.jpg" width="48" />
              <div>
                <p class="font-semibold text-purple-700">
                  Issac Cassanova
                </p>
                <p class="text-gray-600 text-sm mb-1">
                  Loved the lightstick! Worked perfectly and looked nice. Smooth rental process!
                </p>
                <div class="text-purple-700 text-sm">
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                </div>
              </div>
            </div>
            <div class="flex space-x-4">
              <img alt="Profile picture of Snopia Elvira, female with long hair"
                class="w-12 h-12 rounded-full object-cover" height="48"
                src="https://storage.googleapis.com/a1aa/image/d62830be-2916-4583-6363-0f646094b15f.jpg" width="48" />
              <div>
                <p class="font-semibold text-purple-700">
                  Snopia Elvira
                </p>
                <p class="text-gray-600 text-sm mb-1">
                  Great service, good quality lightstick, and no hassle at all. Would rent again!
                </p>
                <div class="text-purple-700 text-sm">
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                  <i class="fas fa-star">
                  </i>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div>
          <h3 class="font-semibold text-gray-700 text-xl mb-4">
            Add a Review
          </h3>
          <form class="space-y-4">
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-1" for="rating">
                Add Your Rating
              </label>
              <div class="flex space-x-1 text-purple-700 text-lg cursor-pointer" id="rating">
                <i class="far fa-star" title="1 star">
                </i>
                <i class="far fa-star" title="2 stars">
                </i>
                <i class="far fa-star" title="3 stars">
                </i>
                <i class="far fa-star" title="4 stars">
                </i>
                <i class="far fa-star" title="5 stars">
                </i>
              </div>
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-1" for="name">
                Name
              </label>
              <input
                class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300"
                id="name" name="name" placeholder="Your name" type="text" />
            </div>
            <div>
              <label class="block text-sm font-semibold text-gray-700 mb-1" for="review">
                Write Your Review
              </label>
              <textarea
                class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300 resize-none"
                id="review" name="review" placeholder="Great" rows="3"></textarea>
            </div>
            <button class="w-full bg-purple-700 text-white py-2 rounded-md font-semibold hover:bg-purple-800"
              type="submit">
              Submit
            </button>
          </form>
        </div>
      </div>

    </div>
  </section>


  <!-- ========== SCRIPT INTERAKSI ========== -->
  <script>
    // Daftar gambar thumbnail
    const thumbnails = [
      "https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg", // Gambar versi 1
      "https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg", // Gambar versi 2
      "https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg", // Gambar versi 3
      "https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain" // Gambar versi 4
    ];

    let currentIndex = 0;
    const mainImage = document.querySelector(".relative img");
    const prevButton = document.getElementById("prev-image-btn");
    const nextButton = document.getElementById("next-image-btn");

    function changeImage(direction) {
      currentIndex += direction;
      if (currentIndex < 0) {
        currentIndex = 0;
      } else if (currentIndex >= thumbnails.length) {
        currentIndex = thumbnails.length - 1;
      }
      mainImage.src = thumbnails[currentIndex];
      updateActiveThumbnail();
      updateButtonStates();
    }

    function updateButtonStates() {
      if (currentIndex === 0) {
        prevButton.disabled = true;
      } else {
        prevButton.disabled = false;
      }
      if (currentIndex === thumbnails.length - 1) {
        nextButton.disabled = true;
      } else {
        nextButton.disabled = false;
      }
    }

    updateButtonStates();

    const thumbnailImgs = document.querySelectorAll(".thumbnail");
    function updateActiveThumbnail() {
      thumbnailImgs.forEach((img, index) => {
        if (index === currentIndex) {
          img.classList.add("border-[#6B549A]"); // Tambahkan kelas aktif
        } else {
          img.classList.remove("border-[#6B549A]"); // Hapus kelas aktif
        }
      });
    }

    thumbnailImgs.forEach((img, index) => {
      img.addEventListener("click", () => {
        currentIndex = index;
        mainImage.src = thumbnails[currentIndex];
        updateActiveThumbnail();
      });
    });

    updateActiveThumbnail();

    // Pilih versi lightstick
    const versionButtons = document.querySelectorAll(".version-btn");
    versionButtons.forEach((btn) => {
      btn.addEventListener("click", () => {
        versionButtons.forEach((b) => {
          b.classList.remove("bg-[#EFD0EF]", "text-white");
          b.classList.add("border", "border-gray-300", "text-[#8B7CC4]");
        });

        // Tambahkan style ke tombol yang diklik
        btn.classList.remove("border", "border-gray-300", "text-[#8B7CC4]");
        btn.classList.add("bg-[#EFD0EF]", "text-white");

        // Ambil versi terpilih
        const selectedVersion = btn.getAttribute("data-version");

        // Ganti gambar utama berdasarkan versi
        currentIndex = selectedVersion - 1;
        mainImage.src = thumbnails[currentIndex];

        // Perbarui status thumbnail
        updateActiveThumbnail();
      });
    });

    // Tambah/Kurang Quantity
    const decreaseBtn = document.querySelector(
      'button[aria-label="Decrease quantity"]'
    );
    const increaseBtn = document.querySelector(
      'button[aria-label="Increase quantity"]'
    );
    const quantitySpan = document.querySelector("span.text-xl");
    let quantity = parseInt(quantitySpan.textContent);

    decreaseBtn.addEventListener("click", () => {
      if (quantity > 1) {
        quantity--;
        quantitySpan.textContent = quantity;
      }
    });

    increaseBtn.addEventListener("click", () => {
      quantity++;
      quantitySpan.textContent = quantity;
    });

    // Tanggal Sewa
    const selectDateBtn = document.getElementById("select-date-btn");
    const datepickerWrapper = document.getElementById("datepicker-wrapper");
    const startDateInput = document.getElementById("start-date");
    const endDateInput = document.getElementById("end-date");

    // Inisialisasi Flatpickr untuk input tanggal mulai
    const startPicker = flatpickr(startDateInput, {
      minDate: "today",
      dateFormat: "Y-m-d",
      onChange: function (selectedDates) {
        if (selectedDates.length > 0) {
          endPicker.set("minDate", selectedDates[0]);
        }
      },
    });

    // Inisialisasi Flatpickr untuk input tanggal selesai
    const endPicker = flatpickr(endDateInput, {
      minDate: "today",
      dateFormat: "Y-m-d",
    });

    // Toggle tampilan datepicker saat tombol "Pilih Tanggal" diklik
    selectDateBtn.addEventListener("click", () => {
      datepickerWrapper.classList.toggle("hidden");
    });

    // Ambil elemen untuk tombol dan konten tab
    const descriptionBtn = document.getElementById("description-btn");
    const detailsBtn = document.getElementById("details-btn");
    const descriptionContent = document.getElementById("description");
    const detailsContent = document.getElementById("details");

    descriptionBtn.addEventListener("click", () => {
      descriptionContent.classList.remove("hidden");
      detailsContent.classList.add("hidden");
      descriptionBtn.classList.add("border-b-4", "border-[#2E1B5F]");
      detailsBtn.classList.remove("border-b-4");
    });

    detailsBtn.addEventListener("click", () => {
      detailsContent.classList.remove("hidden");
      descriptionContent.classList.add("hidden");
      detailsBtn.classList.add("border-b-4", "border-[#2E1B5F]");
      descriptionBtn.classList.remove("border-b-4");
    });

    //Bintang dan Rating
    const ratingStars = document.querySelectorAll('#rating i');
    let selectedRating = 0;

    function setRating(rating) {
      ratingStars.forEach((star, index) => {
        if (index < rating) {
          star.classList.remove('far'); // hilangin outline
          star.classList.add('fas');     // tambahin solid
        } else {
          star.classList.remove('fas');
          star.classList.add('far');
        }
      });
    }

    ratingStars.forEach((star, index) => {
      star.addEventListener('click', () => {
        selectedRating = index + 1; // index mulai 0, makanya +1
        setRating(selectedRating);
      });
    });

  </script>
</body>

</html>