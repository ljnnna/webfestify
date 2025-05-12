<div class="w-full md:w-1/3 bg-gradient-to-b from-purple-100 to-purple-50 p-6 rounded-xl shadow-xl">
    <h2 class="text-xl font-semibold mb-4">Cart Details</h2>
    <div class="flex justify-between mb-4">
        <span>ITEMS {{ $itemCount }}</span>
        <span>IDR {{ number_format($total, 0, ',', '.') }}</span>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">SHIPPING</label>
        <select class="w-full border rounded px-3 py-2">
            <option>Choose</option>
        </select>
    </div>
    <div class="mb-4">
        <label class="block text-sm font-medium mb-1">VOUCHER</label>
        <select class="w-full border rounded px-3 py-2">
            <option>Choose</option>
        </select>
    </div>
    <div class="flex justify-between font-semibold mt-6">
        <span>Total Price:</span>
        <span>IDR {{ number_format($grandTotal, 0, ',', '.') }}</span>
    </div>
    <button class="w-full mt-4 py-3 bg-purple-600 text-white rounded-xl shadow-lg hover:bg-purple-700 transition">
        CHECKOUT
    </button>
</div>
