<!-- Cart Item -->
<div class="cart-item grid sm:grid-cols-5 gap-4 items-start p-4 mt-4 rounded-xl bg-gradient-to-r from-purple-100 to-indigo-50 shadow text-sm sm:text-base" data-price="25000">
  
  <!-- COL 1: Checkbox + Image + Deskripsi Produk (full width on mobile) -->
  <div class="flex items-start gap-2 col-span-full sm:col-span-2">
    <input type="checkbox" class="item-check w-4 h-4 mt-1" checked />
    <img src="/images/{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-14 h-14 object-cover rounded-md" />
    <div>
      <div class="font-medium">{{ $item['name'] }}</div>
      <div class="text-xs text-gray-700">{{ $item['version'] }}</div>
    </div>
  </div>

  <!-- BOTTOM SECTION (stacked in row on mobile) -->
  <div class="flex justify-between items-center gap-2 col-span-full sm:col-span-3 flex-wrap sm:flex-nowrap mt-2 sm:mt-0">

    <!-- Quantity -->
    <div class="flex justify-center items-center border rounded-md bg-white">
      <button class="decrement px-2 py-1 text-lg">−</button>
      <div class="count px-2 py-1">1</div>
      <button class="increment px-2 py-1 text-lg">+</button>
    </div>

    <!-- Price -->
    <div class="text-gray-700 whitespace-nowrap">IDR.25.000/Day</div>

    <!-- Delete -->
    <button class="remove mr-4 text-gray-800 font-bold text-base">X</button>
  </div>
</div>
