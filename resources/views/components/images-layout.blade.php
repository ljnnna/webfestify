<div class="w-full bg-white mb-6 px-4 py-4">
    <!-- Gambar Besar -->
    <div class="w-full h-60 bg-blue-800 flex items-center justify-center text-white text-xl font-semibold mb-2 rounded-lg overflow-hidden">
        <img src="{{ asset('images/blackpink.jpg') }}" alt="Gambar Besar" class="object-cover w-full h-full">
    </div>

    <!-- Tiga Gambar Kecil di Bawah -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2">
        <div class="h-40 bg-blue-700 rounded-lg overflow-hidden">
            <img src="{{ asset('images/gambarkamera.jpg') }}" alt="Gambar 1" class="w-full h-40 object-cover rounded-md">
        </div>
        <div class="h-40 bg-blue-700 rounded-lg overflow-hidden">
            <img src="{{ asset('images/kursilipat.jpg') }}" alt="Gambar 2" class="w-full h-40 object-cover rounded-md">
        </div>
        <div class="h-40 bg-blue-700 rounded-lg overflow-hidden">
            <img src="{{ asset('images/babymonster.jpg') }}" alt="Gambar 3" class="w-full h-40 object-cover rounded-md">
        </div>
    </div>
</div>
