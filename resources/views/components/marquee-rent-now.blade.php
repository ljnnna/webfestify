<section class="overflow-hidden bg-gradient-to-r from-blue-900 to-purple-900 bg-opacity-50 mt-8">
  <div class="relative w-full">
    <div id="marquee-track" class="flex whitespace-nowrap font-bold text-white py-2 text-base sm:text-lg gap-6">
      <span class="inline-block">RENT NOW RENT NOW RENT NOW RENT NOW RENT NOW RENT NOW</span>
      <span class="inline-block">RENT NOW RENT NOW RENT NOW RENT NOW RENT NOW RENT NOW</span>
      <span class="inline-block">RENT NOW RENT NOW RENT NOW RENT NOW RENT NOW RENT NOW</span>
    </div>
  </div>
</section>

<style>
@keyframes rentMarquee {
  0% {
    transform: translateX(0%);
  }
  100% {
    transform: translateX(-50%);
  }
}

#marquee-track {
  animation: rentMarquee 15s linear infinite;
  will-change: transform;
  min-width: 200%; 
}
</style>
