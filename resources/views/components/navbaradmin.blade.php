<div class="fixed top-0 left-0 right-0 h-16 flex justify-between items-center p-4 border-b bg-white z-20">
    <div class="flex-1 text-center">
        <img src="{{ asset('images/logofestify.png') }}" alt="Logo" class="mx-auto h-10" />
    </div>
    <div class="flex items-center gap-6 mr-8">
        <!-- Icon Lonceng dengan Modal Notifikasi -->
        <div x-data="{ openNotification: false }" class="relative">
            <!-- Icon lonceng -->
            <button @click="openNotification = !openNotification" class="focus:outline-none relative">
                <x-icon name="bell" class="text-[#493862] text-xl hover:text-purple-300 transition duration-200" />
                <!-- Badge notifikasi (opsional) -->
                 @if($newOrderCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-4 w-4 flex items-center justify-center">
                    {{ $newOrderCount }}
                </span>
                @endif
            </button>

            <!-- Modal Notifikasi -->
            <div 
                x-show="openNotification" 
                @click.away="openNotification = false" 
                x-transition 
                class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg border border-gray-200 z-50 max-h-96 overflow-y-auto"
            >
                <!-- Header Modal -->
                <div class="px-4 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Notifikasi</h3>
                </div>

                <!-- List Notifikasi -->
                <div class="divide-y divide-gray-200">
                    <!-- Notifikasi 1 -->
                    @foreach($orders as $order)
                    <div class="px-4 py-3 hover:bg-gray-50">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <x-icon name="calendar" class="w-4 h-4 text-blue-600" />
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm font-medium text-gray-900">Penyewaan Baru</p>
                                <p class="text-sm text-gray-600">
                                    {{ $order->order_code }}, {{ $order->user->name }} menyewa untuk tanggal {{ \Carbon\Carbon::parse($order->start_date)->translatedFormat('d F Y') }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">
                                    {{ $order->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Footer Modal -->
                <div class="px-4 py-3 border-t border-gray-200">
                    <a href="#" class="text-sm text-[#493862] hover:text-purple-600 font-medium">Lihat semua notifikasi</a>
                </div>
            </div>
        </div>

        <div x-data="{ open: false }" class="relative">
    <!-- Icon user -->
    <button @click="open = !open" class="focus:outline-none">
        <x-icon name="user" class="text-[#493862] text-xl hover:text-purple-300 transition duration-200" />
    </button>

    <!-- Pop-out menu -->
    <div 
        x-show="open" 
        @click.away="open = false" 
        x-transition 
        class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg border border-black-700 outline outline-1 outline-black-500 z-50"
    >
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
        >
            <x-icon name="fa-solid fa-right-from-bracket" class="w-4 h-4 mr-2" />
            Logout
        </a>

        <!-- Form untuk logout -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
    </div>
</div>

<!-- 493862 -->