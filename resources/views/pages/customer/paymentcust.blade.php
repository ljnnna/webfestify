<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Order Details
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <style>
   @import url("https://fonts.googleapis.com/css2?family=Inter:wght@600;700&display=swap");
    body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-gradient-to-b from-[#F9D9FF] to-[#D9D9FF] min-h-screen flex items-center justify-center p-8">
  <main class="max-w-6xl w-full bg-white/90 rounded-xl shadow-md p-10 grid grid-cols-1 md:grid-cols-2 gap-10">
   <!-- Left side -->
   <section>
    <h1 class="text-[36px] font-extrabold text-[#5B4B7A] mb-6 border-b border-gray-300 pb-2">
     ORDER DETAILS
    </h1>
    <article class="bg-white rounded-xl shadow-sm p-6 space-y-6 max-w-md">
     <div class="flex gap-4">
      <img alt="Hand holding a Seventeen Lightstick with a transparent globe and black handle" class="w-20 h-20 rounded-lg object-cover" height="80" src="https://storage.googleapis.com/a1aa/image/8e5de89e-3b57-4e9b-c840-761c2816584f.jpg" width="80"/>
      <div class="flex flex-col justify-center text-[#4B3B6B]">
       <h2 class="font-semibold text-base leading-tight">
        Seventeen Lightstick
       </h2>
       <p class="text-sm font-normal leading-tight">
        Ver.2
       </p>
       <p class="font-semibold text-sm mt-1">
        Rental Period:
        <span class="font-normal">
         2 Day
        </span>
       </p>
      </div>
     </div>
     <p class="text-[#4B3B6B] font-semibold text-sm leading-snug">
      Lightstick versi terbaru dengan fitur getar dan lampu warna-warni.
     </p>
     <div class="border-t border-gray-300 pt-4 space-y-2 text-[#4B3B6B] font-semibold text-sm">
      <div class="flex justify-between">
       <span>
        Sub Total
       </span>
       <span>
        Rp. 50.000
       </span>
      </div>
      <div class="flex justify-between">
       <span>
        Service Fee
       </span>
       <span>
        Rp. 2.500
       </span>
      </div>
      <div class="flex justify-between">
       <span>
        Deposit (50%)
       </span>
       <span>
        Rp. 25.000
       </span>
      </div>
      <div class="flex justify-between">
       <span>
        Shipping Costs
       </span>
       <span>
        Rp. 20.000
       </span>
      </div>
     </div>
     <div class="border-t border-gray-300 pt-4 flex justify-between font-extrabold text-[#5B4B7A] text-lg">
      <span>
       Total
      </span>
      <span>
       Rp.97.500
      </span>
     </div>
    </article>
    <div class="mt-8 flex justify-center">
  <button class="max-w-xs w-full ml-[-65px] py-3 text-[#5B4B7A] font-extrabold text-lg rounded-full bg-gradient-to-r from-[#B6B0F7] to-[#F9D9FF] shadow-md hover:brightness-105 transition" type="button">
    CANCEL ORDER
  </button>
</div>

   </section>
   <!-- Right side -->
   <section class="flex flex-col justify-between">
    <form class="space-y-6 max-w-md w-full">
     <div>
      <label class="block mb-2 font-semibold text-[#4B3B6B]" for="fullname">
       Full Name / username
      </label>
      <input class="w-full rounded-lg border border-gray-300 p-4 text-[#A59FC6] placeholder-[#A59FC6] focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:border-transparent" id="fullname" placeholder="Full Name /username" type="text"/>
     </div>
     <div>
      <label class="block mb-2 font-semibold text-[#4B3B6B]" for="address">
       Address
      </label>
      <textarea class="w-full rounded-lg border border-gray-300 p-4 text-[#A59FC6] placeholder-[#A59FC6] resize-none focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:border-transparent" id="address" placeholder="Address" rows="2"></textarea>
     </div>
     <div>
      <label class="block mb-2 font-semibold text-[#4B3B6B]" for="payment">
       Payment Method
      </label>
      <select class="w-full rounded-lg border border-gray-300 p-4 text-[#A59FC6] placeholder-[#A59FC6] focus:outline-none focus:ring-2 focus:ring-[#B6B0F7] focus:border-transparent appearance-none" id="payment">
       <option disabled="" selected="">
        Select Payment Method
       </option>
       <option>
        QRIS
       </option>
      </select>
     </div>
     <hr class="border-gray-300"/>
     <div class="flex items-center gap-2 justify-center">
  <input class="w-4 h-4 border border-gray-400 rounded-sm" id="terms" type="checkbox"/>
  <label class="text-black text-sm" for="terms">
    I have read and agree to the terms and conditions
  </label>
</div>

     <button class="mt-4 w-full py-4 text-[#5B4B7A] font-extrabold text-xl rounded-full bg-gradient-to-r from-[#B6B0F7] to-[#F9D9FF] shadow-md hover:brightness-105 transition" type="submit">
      Pay Rp. 62.500
     </button>
    </form>
    <button class="mt-6 self-end flex items-center gap-2 text-black text-sm font-normal" type="button">
     <i class="fas fa-arrow-left">
     </i>
     Back To Cart
    </button>
   </section>
  </main>
 </body>
</html>
