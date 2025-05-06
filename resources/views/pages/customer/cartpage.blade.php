<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Eestify Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Navbar -->
  <!-- <nav class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-purple-600">Eestify</h1>
    <div class="space-x-4">
      <button onclick="showPage('shop')" class="text-purple-600 hover:underline">Shop</button>
      <button onclick="showPage('cart')" class="text-purple-600 hover:underline">Cart</button>
      <button onclick="showPage('checkout')" class="text-purple-600 hover:underline">Checkout</button>
    </div>
  </nav> -->

  <!-- Pages -->
  <main class="flex-1 p-6">

    <!-- Shop Page -->
    <section id="shop" class="page">
      <h2 class="text-2xl font-bold mb-6">Products</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-xl shadow-md">
          <img src="https://via.placeholder.com/150" alt="Product" class="w-full mb-4 rounded-md">
          <h3 class="font-semibold text-lg">Lightstick Seventeen Ver.2</h3>
          <p class="text-gray-600 mb-2">Rp.25.000/hari</p>
          <button onclick="addToCart('Lightstick Seventeen Ver.2', 25000)" class="w-full bg-purple-600 text-white py-2 rounded-xl hover:bg-purple-700">Add to Cart</button>
        </div>
      </div>
    </section>

    <!-- Cart Page -->
    <section id="cart" class="page hidden">
      <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Left: Product List -->
        <div class="w-full lg:w-2/3">
          <h2 class="text-2xl font-bold mb-6">Your Shopping Cart</h2>
          <div id="cart-items" class="bg-white p-6 rounded-xl shadow-md space-y-4">
            <!-- Items will appear here dynamically -->
          </div>
          <button onclick="showPage('shop')" class="mt-6 inline-flex items-center text-purple-600 hover:underline">
            ← Back To Shop
          </button>
        </div>

        <!-- Right: Cart Details -->
        <div class="w-full lg:w-1/3">
          <div class="bg-gradient-to-b from-purple-100 to-purple-200 p-6 rounded-xl shadow-md space-y-4">
            <h3 class="text-xl font-semibold">Cart Details</h3>
            <div class="flex justify-between text-gray-700">
              <p id="item-count">ITEMS 0</p>
              <p id="item-total">IDR 0</p>
            </div>
            <div>
              <label class="block text-gray-700 mb-1">SHIPPING</label>
              <select class="w-full p-2 rounded-md border">
                <option>Choose Shipping</option>
                <option>JNE - Rp.10.000</option>
                <option>Gojek - Rp.12.000</option>
              </select>
            </div>
            <div>
              <label class="block text-gray-700 mb-1">VOUCHER</label>
              <select class="w-full p-2 rounded-md border">
                <option>Apply Voucher</option>
              </select>
            </div>
            <div class="flex justify-between font-bold text-gray-800 pt-4">
              <p>Total Price:</p>
              <p id="total-price">IDR 0</p>
            </div>
            <button onclick="showPage('checkout')" class="w-full bg-purple-600 text-white py-3 rounded-xl hover:bg-purple-700 font-bold">
              CHECKOUT
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Checkout Page -->
    <section id="checkout" class="page hidden">
      <h2 class="text-2xl font-bold mb-6">Checkout</h2>
      <div class="bg-white p-6 rounded-xl shadow-md space-y-4 max-w-lg mx-auto">
        <div>
          <label class="block text-gray-600 mb-1">Full Name</label>
          <input type="text" class="w-full p-2 border rounded-md" required>
        </div>
        <div>
          <label class="block text-gray-600 mb-1">Address</label>
          <textarea class="w-full p-2 border rounded-md" required></textarea>
        </div>
        <div>
          <label class="block text-gray-600 mb-1">Payment Method</label>
          <select class="w-full p-2 border rounded-md" required>
            <option>Bank Transfer</option>
            <option>Credit Card</option>
            <option>QRIS</option>
          </select>
        </div>
        <button type="submit" class="w-full bg-purple-600 text-white py-3 rounded-xl hover:bg-purple-700 font-bold">
          Confirm and Pay
        </button>
      </div>
    </section>

  </main>

  <!-- Footer -->
  <footer class="bg-white text-center p-4 text-gray-600 mt-8">
    &copy; 2025 Eestify
  </footer>

  <!-- Scripts -->
  <script>
  // Navigasi antar halaman
  function showPage(pageId) {
    const pages = document.querySelectorAll('.page');
    pages.forEach(page => {
      page.classList.toggle('hidden', page.id !== pageId);
    });
    if (pageId === 'cart') renderCart();
  }

  let cart = [];
  let shippingCost = 0;
  let discount = 0;

  function addToCart(productName, price) {
    const existingProduct = cart.find(item => item.name === productName);
    if (existingProduct) {
      existingProduct.quantity++;
    } else {
      cart.push({ name: productName, price: price, quantity: 1 });
    }
    renderCart();
    showPage('cart');
  }

  function renderCart() {
    const cartContainer = document.querySelector('#cart .bg-white.space-y-4');
    cartContainer.innerHTML = '';

    cart.forEach((item, index) => {
      const itemEl = document.createElement('div');
      itemEl.className = 'flex items-center justify-between border-b pb-4';
      itemEl.innerHTML = `
        <div class="flex items-center gap-4">
          <input type="checkbox" class="w-5 h-5">
          <img src="https://via.placeholder.com/60" alt="Product" class="w-16 rounded-md">
          <div>
            <h3 class="font-semibold">${item.name}</h3>
            <div class="flex items-center mt-2">
              <button onclick="decreaseQuantity(${index})" class="text-xl px-2">-</button>
              <span class="px-2">${item.quantity}</span>
              <button onclick="increaseQuantity(${index})" class="text-xl px-2">+</button>
            </div>
          </div>
        </div>
        <div class="text-right">
          <p class="text-gray-600">Rp.${(item.price * item.quantity).toLocaleString()}/hari</p>
          <button onclick="removeItem(${index})" class="text-red-500 text-sm mt-2">X</button>
        </div>
      `;
      cartContainer.appendChild(itemEl);
    });

    updateCartDetails();
  }

  function increaseQuantity(index) {
    cart[index].quantity++;
    renderCart();
  }

  function decreaseQuantity(index) {
    if (cart[index].quantity > 1) {
      cart[index].quantity--;
    } else {
      cart.splice(index, 1);
    }
    renderCart();
  }

  function removeItem(index) {
    cart.splice(index, 1);
    renderCart();
  }

  function updateCartDetails() {
    const itemsCount = cart.reduce((sum, item) => sum + item.quantity, 0);
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

    document.querySelector('#cart .text-gray-700 p:first-child').textContent = `ITEMS ${itemsCount}`;
    document.querySelector('#cart .text-gray-700 p:last-child').textContent = `IDR ${subtotal.toLocaleString()}`;

    const total = subtotal + shippingCost - discount;
    document.querySelector('#cart .font-bold p:last-child').textContent = `IDR ${total.toLocaleString()}`;
  }

  // Event ketika halaman sudah siap
  document.addEventListener('DOMContentLoaded', () => {
    // Tombol add to cart
    const addToCartButton = document.querySelector('#shop button');
    addToCartButton.addEventListener('click', () => {
      addToCart('Lightstick Seventeen Ver.2', 25000);
    });

    // Shipping select
    const shippingSelect = document.querySelector('#cart select:nth-of-type(1)');
    shippingSelect.addEventListener('change', (e) => {
      const value = e.target.value;
      if (value.includes('JNE')) shippingCost = 10000;
      else if (value.includes('Gojek')) shippingCost = 12000;
      else shippingCost = 0;
      updateCartDetails();
    });

    // Voucher select
    const voucherSelect = document.querySelector('#cart select:nth-of-type(2)');
    voucherSelect.innerHTML = `
      <option value="0">Apply Voucher</option>
      <option value="5000">Potongan Rp.5.000</option>
      <option value="10000">Potongan Rp.10.000</option>
    `;
    voucherSelect.addEventListener('change', (e) => {
      discount = parseInt(e.target.value);
      updateCartDetails();
    });

    // Tombol Confirm & Pay
    const confirmPayButton = document.querySelector('#checkout button[type="submit"]');
    confirmPayButton.addEventListener('click', (e) => {
      e.preventDefault();
      alert('Pembayaran Berhasil! Terima kasih sudah belanja di Eestify 💜');
      // Reset semua data
      cart = [];
      shippingCost = 0;
      discount = 0;
      document.querySelector('#checkout form')?.reset();
      showPage('shop');
    });
  });
</script>


</body>
</html>
