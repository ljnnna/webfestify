<div class="w-full flex justify-center">
  <div id="productWrapper" class="w-full max-w-screen-xl px-4"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

<script>
  const products = @json($products);
  const wrapper = document.getElementById("productWrapper");
  let swiper; // variabel global Swiper jika dibutuhkan

  function renderProducts(category) {
    if (swiper) {
      swiper.destroy(true, true);
      swiper = null;
    }

    wrapper.innerHTML = "";

    let filtered;
    if (category === 'others') {
      filtered = products;
    } else {
      filtered = products.filter(product =>
        product.category.name.toLowerCase() === category.toLowerCase()
      );
    }

    if (filtered.length === 0) {
      wrapper.innerHTML = `
        <div class="w-full text-center p-6 bg-white rounded-lg shadow">
          <p class="text-gray-500">No products available in this category.</p>
        </div>
      `;
    } else {
      const grid = document.createElement("div");
      grid.className =
        "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mx-auto justify-items-center";

      filtered.forEach(product => {
        const formattedPrice = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0
        }).format(product.price || 0);

        const item = document.createElement("div");
item.className = `
  bg-white rounded shadow p-4 text-center w-full max-w-[220px]
  transform transition-transform duration-200 hover:-translate-y-1 hover:shadow-xl hover:border hover:border-purple-300
`;
item.innerHTML = `
  <img src="/storage/${product.images[0]?.path}" alt="${product.name}" class="w-full h-40 object-cover rounded-lg mb-4">
  <h4 class="font-semibold  text-gray-800 mb-2 overflow-hidden text-ellipsis whitespace-nowrap">${product.name}</h4>
  <p class="text-sm text-gray-700 mb-4">${formattedPrice}/day</p>
  <a href="/product/${product.slug ?? ''}" 
    class="bg-purple-200 text-purple-800 px-6 py-2 rounded-xl font-medium hover:bg-purple-300 transition">
    Details
  </a>
`;


        grid.appendChild(item);
      });

      wrapper.appendChild(grid);
    }
  }

  // ✅ Event listener utama DOM
  document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll(".category-btn");

    function updateActiveButton(selectedCategory) {
      buttons.forEach(btn => {
        const category = btn.getAttribute("data-category");
        if (category === selectedCategory) {
          btn.classList.remove("bg-gray-100", "text-gray-500");
          btn.classList.add("bg-purple-200", "text-purple-800");
        } else {
          btn.classList.remove("bg-purple-200", "text-purple-800");
          btn.classList.add("bg-gray-100", "text-gray-500");
        }
      });
    }

    const defaultCategory = 'others';
    renderProducts(defaultCategory);
    updateActiveButton(defaultCategory);

    buttons.forEach(btn => {
      btn.addEventListener("click", () => {
        const selected = btn.getAttribute("data-category");
        renderProducts(selected);
        updateActiveButton(selected);
      });
    });
  });
</script>
