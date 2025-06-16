<!-- Quantity & Actions -->
<div class="mb-8 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                <div class="flex items-center space-x-4">
                    <label class="text-[#6D5983] font-semibold">Quantity:</label>
                    <div class="flex items-center border-2 border-gray-200 rounded overflow-hidden w-32">
                        <button id="decrease-qty"
                            class="flex-1 py-2 text-xl text-[#6D5983] font-bold hover:bg-gray-50 transition-colors">-</button>
                        <span id="qty-display"
                            class="w-12 text-center py-2 text-lg font-semibold text-[#6D5983] border-x border-gray-300">1</span>
                        <button id="increase-qty"
                            class="flex-1 py-2 text-xl text-[#6D5983] font-bold hover:bg-gray-50 transition-colors">+</button>
                    </div>
                </div>

                @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<script>
const quantityController = {
    quantity: 1,
    decreaseBtn: null,
    increaseBtn: null,
    display: null,

    init() {
        this.decreaseBtn = document.getElementById('decrease-qty');
        this.increaseBtn = document.getElementById('increase-qty');
        this.display = document.getElementById('qty-display');

        if (this.decreaseBtn && this.increaseBtn && this.display) {
            // Hapus event listener lama jika ada (opsional, tapi aman)
            this.decreaseBtn.replaceWith(this.decreaseBtn.cloneNode(true));
            this.increaseBtn.replaceWith(this.increaseBtn.cloneNode(true));

            // Ambil ulang elemen setelah replace
            this.decreaseBtn = document.getElementById('decrease-qty');
            this.increaseBtn = document.getElementById('increase-qty');

            this.bindEvents();
            this.updateDisplay();
        } else {
            console.warn('Quantity elements not found in DOM');
        }
    },

    bindEvents() {
        this.decreaseBtn.addEventListener('click', () => this.decrease());
        this.increaseBtn.addEventListener('click', () => this.increase());
    },

    decrease() {
        if (this.quantity > 1) {
            this.quantity--;
            this.updateDisplay();
        }
    },

    increase() {
        if (this.quantity <script PRODUCT_CONFIG.maxQuantity) {
            this.quantity++;
            this.updateDisplay();
        }
    },

    updateDisplay() {
        this.display.textContent = this.quantity;
    },

    get() {
        return this.quantity;
    }
};

document.addEventListener('DOMContentLoaded', function () {
    quantityController.init();
    imageGallery.init();
});

</script>