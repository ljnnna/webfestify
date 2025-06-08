<div>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

  <h3 class="text-xl font-bold mb-6">Cart Details</h3>

  <div class="flex justify-between mb-4">
    <span id="item-count">ITEMS 0</span>
    <span id="item-subtotal">IDR 0</span>
  </div>

  <label class="block text-sm mb-1">SHIPPING</label>
  <select id="shipping" class="w-full mb-6 p-2 border rounded-md bg-white">
    <option value="0">Free</option>
    <option value="5000">JNE - IDR 5.000</option>
    <option value="10000">SiCepat - IDR 10.000</option>
  </select>

  <label class="block text-sm mb-1">VOUCHER</label>
  <select id="voucher" class="w-full mb-6 p-2 border rounded-md bg-white">
    <option value="0">None</option>
    <option value="0.1">10% OFF</option>
  </select>

  <div class="flex justify-between font-bold text-lg mb-6">
    <span>Total Price :</span>
    <span id="total-price">IDR 0</span>
  </div>

<button onclick="window.location.href='{{ route('payment') }}'" class="w-full bg-purple-900 text-white py-2 rounded-2xl font-semibold text-lg">
  CHECKOUT
</button>

</div>
