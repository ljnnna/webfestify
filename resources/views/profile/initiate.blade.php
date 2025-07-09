@extends('layouts.app')

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

@section('content')
<div class="container mx-auto px-4 py-10">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 p-6">
        <h2 class="text-xl font-bold text-center text-indigo-800 mb-2 flex justify-center items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Equipment Return Process
        </h2>
        <p class="text-sm text-gray-600 text-center max-w-2xl mx-auto mb-6">
            Please select your preferred return method and confirm your return request.
        </p>

        <form id="returnForm" action="{{ route('return.create', ['order' => $order->id, 'orderProduct' => $orderProduct->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="return_option" id="returnOptionInput" value="dropoff">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <!-- Drop Off -->
                <div onclick="selectOption('dropoff')" id="option-dropoff"
                    class="return-option bg-gray-50 rounded-lg p-6 border-2 border-indigo-600 cursor-pointer transition duration-200 text-center">
                    <div class="text-indigo-600 text-2xl mb-2">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16M9 7h1m-1 4h1m4-4h1m-1 4h1"/>
                        </svg>
                    </div>
                    <h4 class="text-sm font-semibold text-gray-800 mb-1">In-Person Drop Off</h4>
                    <p class="text-xs text-gray-600">Return equipment to our location during business hours</p>
                </div>

                <!-- Pickup -->
                <div onclick="selectOption('pickup')" id="option-pickup"
                    class="return-option bg-gray-50 rounded-lg p-6 border border-gray-200 cursor-pointer transition duration-200 hover:border-indigo-400 text-center">
                    <div class="text-gray-600 text-2xl mb-2">
                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h4 class="text-sm font-semibold text-gray-800 mb-1">Scheduled Pickup</h4>
                    <p class="text-xs text-gray-600">We'll collect the equipment from your location</p>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-gradient-to-r from-indigo-600 to-indigo-800 text-white py-3 px-6 rounded-lg font-semibold text-sm hover:shadow-md transition-all duration-200">
                Initiate Return Process
            </button>
        </form>
    </div>
</div>

<script>
    function selectOption(option) {
        document.getElementById('returnOptionInput').value = option;

        const drop = document.getElementById('option-dropoff');
        const pick = document.getElementById('option-pickup');

        if (option === 'dropoff') {
            drop.classList.add('border-indigo-600');
            drop.classList.remove('border-gray-200');
            pick.classList.remove('border-indigo-600');
            pick.classList.add('border-gray-200');
        } else {
            pick.classList.add('border-indigo-600');
            pick.classList.remove('border-gray-200');
            drop.classList.remove('border-indigo-600');
            drop.classList.add('border-gray-200');
        }
    }
</script>
@endsection
