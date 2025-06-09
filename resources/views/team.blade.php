@extends('layouts.ourteam')

@section('title', 'Our Team - Festify')

@section('desktop-menu')

    <div class="hidden lg:flex space-x-6 items-center">
        

        
        <a href="{{ route('home') }}"
            class="{{ request()->routeIs('home') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
              Home
        </a>

        <a href="{{ url('/catalog') }}"
           class="{{ Request::is('catalog') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
            Catalog
        </a>

        <a href="{{ url('/team') }}"
           class="{{ Request::is('team') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
            Team
        </a>

        <a href="{{ url('/contact') }}"
           class="{{ Request::is('contact') ? 'bg-purple-300 dark:bg-purple-700 text-purple-900 dark:text-white' : 'text-gray-700 hover:text-purple-700 dark:text-gray-300 dark:hover:text-white' }} px-3 py-2 rounded-lg">
            Contact
        </a>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
@endsection

@section('content')
    @include('layouts.navigation')
    @include('components.teamgrid')
@endsection