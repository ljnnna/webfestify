<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <title>Catalog Customer</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Inter", sans-serif;
        }
    </style>
</head>

<body class="bg-white">
    <!-- Navbar -->
    <nav class="shadow-md shadow-[#D9C9F9] flex items-center justify-between px-4 sm:px-6 md:px-10 py-4"
        style="background: linear-gradient(to right, #eae1f9, #f5edfb)">
        <div class="flex items-center space-x-6">
            <img alt="Festify" class="h-10 w-auto" height="40" src="images/logofestify.png" width="100" />
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
        <div class="flex items-center space-x-6">
            <div class="relative w-64 hidden md:block">
                <input
                    class="w-full rounded-full py-2 pl-4 pr-10 text-sm text-[#493862] font-normal shadow-[0_4px_10px_rgba(0,0,0,0.1)] focus:outline-none"
                    placeholder="Camera" type="search" />
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

    <!-- Main content -->
    <main class="max-w-[1200px] mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-5 gap-8">
        <!-- Left text block -->
        <section
            class="col-span-1 md:col-span-2 bg-gradient-to-b from-[#FDE7FF] to-[#D9E4FF] rounded-xl p-8 shadow-md max-w-md max-h-[250px] mx-auto md:mx-0">
            <h1 class="text-[#2E2A4A] font-extrabold text-3xl leading-[40px] mb-4">
                Find your favorite camera!!
            </h1>
            <p class="text-[#2E2A4A] font-normal text-lg leading-7">
                "Experience every concert moment through the perfect lens."
            </p>
        </section>

        <!-- Right cards grid -->
        <section class="col-span-1 md:col-span-3 grid grid-cols-1 sm:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
                <img alt="Nikon Coolpix S9300 Digital Camera (Silver)"
                    class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250"
                    src="https://www.bhphotovideo.com/images/images2500x2500/Nikon_26314_Coolpix_S9300_Digital_Camera_842361.jpg" width="250" />
                <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
                Nikon Coolpix S9300 Digital Camera
                </h3>
                <p class="text-[#493862] text-xs w-full mb-4">
                    Rp250.000/day
                </p>
                <a href="details_product_catalog_customer.html"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                    Details
                </a>
            </article>
            <!-- Card 2 -->
            <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
                <img alt="FUJIFILM FinePix S3200 14MP Digital Camera (Black)"
                    class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250"
                    src="https://www.bhphotovideo.com/images/images2500x2500/Fujifilm_16123737_Finepix_S3200_Digital_Camera_749766.jpg" width="250" />
                <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
                FUJIFILM FinePix S3200 14MP Digital Camera
                </h3>
                <p class="text-[#493862] text-xs w-full mb-4">
                    Rp200.000/day
                </p>
                <a href="details_product_catalog_customer.html"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                    Details
                </a>
            </article>
            <!-- Card 3 -->
            <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
                <img alt="Sony DSC-WX350"
                    class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250"
                    src="https://camerok.com/images/DS/DSC-WX350P/8a8d/d/Sony-DSC-WX350-1.jpg" width="250" />
                <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
                Sony DSC-WX350
                </h3>
                <p class="text-[#493862] text-xs w-full mb-4">
                    Rp275.000/day
                </p>
                <a href="details_product_catalog_customer.html"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                    Details
                </a>
            </article>
            <!-- Card 4 -->
            <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
                <img alt="Panasonic Lumix DMC-FZ150 Compact Digital Camera"
                    class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250"
                    src="https://www.ephotozine.com/articles/panasonic-lumix-dmc-fz150-compact-digital-camera-17284/images/highres-panasoniclumixdmcFZ150slant_1314347165.jpg" width="250" />
                <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
                Panasonic Lumix DMC-FZ150 Compact Digital Camera
                </h3>
                <p class="text-[#493862] text-xs w-full mb-4">
                    Rp250.000/day
                </p>
                <a href="details_product_catalog_customer.html"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                    Details
                </a>
            </article>
            <!-- Card 5 -->
            <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
                <img alt="Canon PowerShot G9 X Digital Camera (Black)"
                    class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250"
                    src="https://th.bing.com/th/id/R.b1087bcec46f959bf1c9061b27547d11?rik=rOXTyNbb5UIrAw&riu=http%3a%2f%2fwww.bhphotovideo.com%2fimages%2fimages2500x2500%2fcanon_0511c001_powershot_g9x_digital_camera_1188053.jpg&ehk=qZCTSTB1tayIS1iOHrvAr6vrGAkjUuTZdJ%2bMWv0Nc5g%3d&risl=&pid=ImgRaw&r=0" width="250" />
                <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
                Canon PowerShot G9 X Digital Camera
                </h3>
                <p class="text-[#493862] text-xs w-full mb-4">
                    Rp150.000/day
                </p>
                <a href="details_product_catalog_customer.html"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                    Details
                </a>
            </article>
            <!-- Card 6 -->
            <article class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col items-center">
                <img alt="Samsung ST76 Compact Digital Camera (Silver)"
                    class="rounded-xl mb-4 w-full max-w-[250px] object-cover" height="250"
                    src="https://www.bhphotovideo.com/images/images1000x1000/Samsung_EC_ST76ZZBPSUS_ST76_Compact_Digital_Camera_839074.jpg" width="250" />
                <h3 class="text-[#493862] font-semibold text-sm w-full mb-1">
                Samsung ST76 Compact Digital Camera (Silver)
                </h3>
                <p class="text-[#493862] text-xs w-full mb-4">
                    Rp250.000/day
                </p>
                <a href="details_product_catalog_customer.html"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center">
                    Details
                </a>
            </article>
        </section>
    </main>
</body>

</html>