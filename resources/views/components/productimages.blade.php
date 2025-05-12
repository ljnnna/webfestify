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