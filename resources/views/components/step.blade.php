@props(['icon', 'title', 'description', 'delay' => ''])

<div class="step flex flex-col sm:flex-row items-start bg-white/30 rounded-xl p-4 sm:p-5 shadow-md {{ $delay }}">
  <img src="{{ $icon }}" alt="Icon" class="w-10 h-10 sm:w-12 sm:h-12 mb-2 sm:mb-0 sm:mr-4" />
  <div>
    <h2 class="text-lg sm:text-xl font-semibold mb-1 sm:mb-2 text-[#b081f5]">{{ $title }}</h2>
    <p class="text-sm sm:text-base">{{ $description }}</p>
  </div>
</div>
