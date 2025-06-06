<form class="space-y-6 max-w-md w-full">
    @csrf
    <div>
        <label class="block mb-2 font-semibold text-[#4B3B6B]" for="fullname">
            Full Name / username
        </label>
        <input
            class="w-full rounded-lg border border-gray-300 p-4 text-[#A59FC6] placeholder-[#A59FC6] focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:border-transparent"
            id="fullname"
            placeholder="Full Name /username"
            type="text"
        />
    </div>
    <div>
        <label class="block mb-2 font-semibold text-[#4B3B6B]" for="address">
            Address
        </label>
        <textarea
            class="w-full rounded-lg border border-gray-300 p-4 text-[#A59FC6] placeholder-[#A59FC6] resize-none focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:border-transparent"
            id="address"
            placeholder="Address"
            rows="2"
        ></textarea>
    </div>
    <div>
        <label class="block mb-2 font-semibold text-[#4B3B6B]" for="payment">
            Payment Method
        </label>
        <select
            class="w-full rounded-lg border border-gray-300 p-4 text-[#A59FC6] placeholder-[#A59FC6] focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:border-transparent appearance-none"
            id="payment"
        >
            <option disabled="" selected="">Select Payment Method</option>
            <option>QRIS</option></select
        >
    </div>
    <hr class="border-gray-300" />
    <div class="flex items-center gap-2 justify-center">
        <input
            class="w-4 h-4 border border-gray-400 rounded-sm"
            id="terms"
            type="checkbox"
        />
        <label class="text-black text-sm" for="terms">
            I have read and agree to the terms and conditions
        </label>
    </div>

    <button
        class="mt-4 w-full py-4 text-[#5B4B7A] font-extrabold text-xl rounded-full bg-gradient-to-r from-[#B6B0F7] to-[#F9D9FF] shadow-md hover:brightness-105 transition"
        type="submit"
    >
        Pay Rp. 62.500
    </button>
</form>
<button
    class="mt-6 self-end flex items-center gap-2 text-black text-sm font-normal"
    type="button"
>
    <i class="fas fa-arrow-left"> </i>
    Back To Cart
</button>
