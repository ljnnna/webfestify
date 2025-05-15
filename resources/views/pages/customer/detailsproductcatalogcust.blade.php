@extends('layouts.details') 

@section('title', 'Details Product')

@section('content')

<!-- ========== Main Content ========== -->
<div
    class="flex flex-col md:flex-row gap-8 px-4 sm:px-6 md:px-10 py-10 max-w-[1280px] mx-auto"
>
    <!-- Product Display -->
    <div class="flex flex-col lg:flex-row items-center lg:items-start gap-10">
        <!-- Product Images -->
        <div class="flex flex-col items-center space-y-6 lg:space-y-10">
            <div class="relative w-72 h-96">
                <img
                    alt="BTS Lightstick with black box behind it, studio product photo"
                    class="w-full h-full object-cover"
                    height="384"
                    src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
                    width="288"
                    id="main-product-image"
                />

                <!-- Image Navigation -->
                <button
                    id="prev-image-btn"
                    aria-label="Previous image"
                    class="absolute top-1/2 -left-10 -translate-y-1/2 bg-white rounded-md p-3 shadow cursor-pointer text-[#2E1B5F] text-xl"
                    onclick="changeImage(-1)"
                >
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button
                    id="next-image-btn"
                    aria-label="Next image"
                    class="absolute top-1/2 -right-10 -translate-y-1/2 bg-[#2E1B5F] rounded-md p-3 shadow cursor-pointer text-white text-xl"
                    onclick="changeImage(1)"
                >
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Thumbnails -->
            <div class="flex space-x-6">
                @foreach([
                'https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg',
                'https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg',
                'https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg',
                'https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain'
                ] as $index => $image)
                <img
                    alt="Thumbnail image of BTS Lightstick, product photo angle {{ $index + 1 }}"
                    class="thumbnail w-18 h-18 object-cover rounded-sm border-2 {{ $index === 0 ? 'border-[#6B549A]' : 'border-transparent' }} cursor-pointer"
                    height="72"
                    src="{{ $image }}"
                    width="72"
                    data-index="{{ $index }}"
                />
                @endforeach
            </div>
        </div>

        <!-- Product Information -->
        <section class="flex-1 max-w-3xl">
            <h1 class="text-[#1A0041] font-extrabold text-3xl mb-1">
                Lightstick - BTS
            </h1>
            <p class="text-[#7F5CB2] text-xl mb-6">Rp.250.000/day</p>

            <!-- Quantity & Actions -->
            <div class="mb-6 flex items-center space-x-4">
                <div
                    aria-label="Quantity selector"
                    class="flex items-center border border-gray-300 rounded-full overflow-hidden w-36"
                >
                    <button
                        aria-label="Decrease quantity"
                        class="flex-1 py-2 text-2xl text-[#6D5983] font-semibold text-center focus:outline-none"
                        id="decrease-qty"
                    >
                        -
                    </button>
                    <span
                        class="w-10 text-center py-2 text-xl font-semibold text-[#6D5983]"
                        id="qty-display"
                    >
                        1
                    </span>
                    <button
                        aria-label="Increase quantity"
                        class="flex-1 py-2 text-2xl text-[#6D5983] font-semibold text-center focus:outline-none"
                        id="increase-qty"
                    >
                        +
                    </button>
                </div>

                <a
                    href=""
                    class="bg-[#6B549A] text-white rounded-full px-8 py-3 font-semibold text-lg"
                >
                    Add To Cart
                </a>

                <a
                    href=""
                    class="bg-[#6B549A] text-white rounded-full px-8 py-3 font-semibold text-lg"
                >
                    Rent Now
                </a>
            </div>

            <!-- Rental Date -->
            <button
                id="select-date-btn"
                class="w-full bg-[#E6D9F7] text-[#8B7CC4] text-lg font-semibold rounded-full py-3"
                type="button"
            >
                Select Rental Date
            </button>

            <!-- Datepicker Container -->
            <div id="datepicker-container" class="mt-4 hidden">
                <input
                    id="rental-date"
                    class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
                    placeholder="Pilih tanggal penyewaan"
                />
            </div>

            <!-- Date Range Picker -->
            <div id="datepicker-wrapper" class="mt-6 space-y-4 hidden">
                <!-- Tanggal Mulai -->
                <div>
                    <label
                        for="start-date"
                        class="block text-[#6D5983] font-semibold mb-1"
                        >Rental Start Date</label
                    >
                    <input
                        id="start-date"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
                        placeholder="Select rental start date"
                    />
                </div>

                <!-- Tanggal Selesai -->
                <div>
                    <label
                        for="end-date"
                        class="block text-[#6D5983] font-semibold mb-1"
                        >Rental End Date</label
                    >
                    <input
                        id="end-date"
                        class="w-full border border-gray-300 rounded-full px-4 py-2 text-[#6D5983] focus:outline-none"
                        placeholder="Select rental end date"
                    />
                </div>
            </div>

            <!-- Deskripsi & Detail -->
            <div class="mt-10 border-t border-gray-300 pt-6 flex space-x-20">
                <button
                    id="description-btn"
                    class="text-[#2E1B5F] font-extrabold text-2xl border-b-4 border-[#2E1B5F] pb-2"
                    type="button"
                >
                    Description
                </button>
                <button
                    id="details-btn"
                    class="text-[#2E1B5F] font-extrabold text-2xl pb-2"
                    type="button"
                >
                    Details
                </button>
            </div>
            <div id="description" class="content">
                <p
                    class="mt-4 text-[#8B7CC4] font-semibold text-base max-w-3xl leading-relaxed"
                >
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed
                    do eiusmod tempor incididunt ut labore et dolore magna
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Duis aute irure dolor in reprehenderit in voluptate velit
                    esse cillum dolore eu fugiat nulla pariatur.
                </p>
            </div>

            <div id="details" class="content hidden">
                <p
                    class="mt-4 text-[#8B7CC4] font-semibold text-base max-w-3xl leading-relaxed"
                >
                    Here are the details about the product, including
                    specifications, features, and other relevant information.
                </p>
            </div>
        </section>
    </div>
</div>

<!-- Customer Reviews -->
@include('components.reviews') @endsection @section('scripts')
<script>
    // Image Gallery
    const thumbnails = [
        "https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg",
        "https://images-cdn.ubuy.co.in/3OBSR3Q-kpop-bts-army-bomb-light-stick-ver-2.jpg",
        "https://images-na.ssl-images-amazon.com/images/I/514NA2icOPL._AC_SL1000_.jpg",
        "https://tse4.mm.bing.net/th/id/OIP.3H__uguti1yf6K5CsD6KbgAAAA?w=350&h=350&rs=1&pid=ImgDetMain",
    ];

    let currentIndex = 0;
    const mainImage = document.getElementById("main-product-image");
    const prevButton = document.getElementById("prev-image-btn");
    const nextButton = document.getElementById("next-image-btn");
    const thumbnailImgs = document.querySelectorAll(".thumbnail");

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
        prevButton.disabled = currentIndex === 0;
        nextButton.disabled = currentIndex === thumbnails.length - 1;
    }

    function updateActiveThumbnail() {
        thumbnailImgs.forEach((img, index) => {
            if (index === currentIndex) {
                img.classList.add("border-[#6B549A]");
                img.classList.remove("border-transparent");
            } else {
                img.classList.remove("border-[#6B549A]");
                img.classList.add("border-transparent");
            }
        });
    }

    thumbnailImgs.forEach((img) => {
        img.addEventListener("click", () => {
            currentIndex = parseInt(img.dataset.index);
            mainImage.src = thumbnails[currentIndex];
            updateActiveThumbnail();
            updateButtonStates();
        });
    });

    updateButtonStates();

    // Quantity Controls
    const decreaseBtn = document.getElementById("decrease-qty");
    const increaseBtn = document.getElementById("increase-qty");
    const quantityDisplay = document.getElementById("qty-display");
    let quantity = parseInt(quantityDisplay.textContent);

    decreaseBtn.addEventListener("click", () => {
        if (quantity > 1) {
            quantity--;
            quantityDisplay.textContent = quantity;
        }
    });

    increaseBtn.addEventListener("click", () => {
        quantity++;
        quantityDisplay.textContent = quantity;
    });

    // Date Picker
    const selectDateBtn = document.getElementById("select-date-btn");
    const datepickerWrapper = document.getElementById("datepicker-wrapper");
    const startDateInput = document.getElementById("start-date");
    const endDateInput = document.getElementById("end-date");

    // Initialize Flatpickr for start date
    const startPicker = flatpickr(startDateInput, {
        minDate: "today",
        dateFormat: "Y-m-d",
        onChange: function (selectedDates) {
            if (selectedDates.length > 0) {
                endPicker.set("minDate", selectedDates[0]);
            }
        },
    });

    // Initialize Flatpickr for end date
    const endPicker = flatpickr(endDateInput, {
        minDate: "today",
        dateFormat: "Y-m-d",
    });

    // Toggle datepicker visibility
    selectDateBtn.addEventListener("click", () => {
        datepickerWrapper.classList.toggle("hidden");
    });

    // Description & Details Tabs
    const descriptionBtn = document.getElementById("description-btn");
    const detailsBtn = document.getElementById("details-btn");
    const descriptionContent = document.getElementById("description");
    const detailsContent = document.getElementById("details");

    descriptionBtn.addEventListener("click", () => {
        descriptionContent.classList.remove("hidden");
        detailsContent.classList.add("hidden");
        descriptionBtn.classList.add("border-b-4", "border-[#2E1B5F]");
        detailsBtn.classList.remove("border-b-4", "border-[#2E1B5F]");
    });

    detailsBtn.addEventListener("click", () => {
        detailsContent.classList.remove("hidden");
        descriptionContent.classList.add("hidden");
        detailsBtn.classList.add("border-b-4", "border-[#2E1B5F]");
        descriptionBtn.classList.remove("border-b-4", "border-[#2E1B5F]");
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
@endsection
