@extends('layouts.catalog') 

@section('title', 'Catalog Customer')

@section('content')
<div class="flex flex-col md:flex-row gap-8">
    @include('components.filtersidebar')

    <!-- Product Grid -->
    <section
        class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 flex-1"
    >
        <!-- Product 1 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="https://th.bing.com/th/id/R.a33422af21dcd4b6268e3f188fec311b?rik=2Z%2bPRjUtA2TQoQ&riu=http%3a%2f%2fkpoptime.com.au%2fcdn%2fshop%2fproducts%2fLightstick-ver3_1200x1200.jpg%3fv%3d1676955016&ehk=DayA3LOByYUvbm1LTwlBJs9cGqZWGeTIOCxz4Gydeec%3d&risl=&pid=ImgRaw&r=0"
                    alt="Lightstick Seventeen"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">
                        Lightstick Seventeen
                    </h3>
                    <p class="text-[#493862] text-xs">Rp200.000/day</p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>

        <!-- Product 2 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="https://m.media-amazon.com/images/I/31CsIQnw0IL._SL500_.jpg"
                    alt="BTS Lightstick"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">
                        BTS Lightstick
                    </h3>
                    <p class="text-[#493862] text-xs">Rp250.000/day</p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>

        <!-- Product 3 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="https://blackpinkstore.com/wp-content/uploads/2022/11/z3904435014876_a9549fa15ef26d076eb970adea2d0f6a.jpg"
                    alt="Blackpink Official Merchandise"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">
                        Blackpink Official Merchandise
                    </h3>
                    <p class="text-[#493862] text-xs">Rp100.000/day</p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>

        <!-- Product 4 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="https://i.pinimg.com/originals/39/5a/c2/395ac26ac2838a51bd8e94179e12828d.jpg"
                    alt="Twice Album Collection"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">
                        Twice Album Collection
                    </h3>
                    <p class="text-[#493862] text-xs">Rp75.000/day</p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>

        <!-- Product 5 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="https://images-cdn.ubuy.co.in/64878b278e41db2b0c79b4b8-newjeans-1st-ep-new-jeans-limited.jpg"
                    alt="NewJeans Photocards"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">
                        NewJeans Photocards
                    </h3>
                    <p class="text-[#493862] text-xs">Rp50.000/day</p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>

        <!-- Product 6 -->
        <article
            class="bg-white rounded-xl shadow-md shadow-gray-300 p-4 flex flex-col h-full"
        >
            <div class="flex-shrink-0 mb-4">
                <img
                    src="https://www.bhphotovideo.com/images/images500x500/ravpower_65_02060_041_rp_pb060_6700_mah_powerbank_1313328.jpg"
                    alt="Concert Banner"
                    class="rounded-xl w-full h-48 object-cover"
                />
            </div>
            <div class="flex flex-col flex-grow justify-between">
                <div class="mb-4">
                    <h3 class="text-[#493862] font-semibold text-sm mb-2">
                        Powerbank
                    </h3>
                    <p class="text-[#493862] text-xs">Rp20.000/day</p>
                </div>
                <a
                    href="{{ route('details') }}"
                    class="bg-[#E6C7E9] text-[#6B5B8A] text-sm rounded-lg py-2 px-8 w-full max-w-[140px] text-center mx-auto"
                >
                    Details
                </a>
            </div>
        </article>
    </section>
</div>
@endsection