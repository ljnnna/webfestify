<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Cart</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="bg-white-100">
  <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- LEFT: Cart Items -->
    <div class="w-full lg:w-2/3 p-6 sm:p-8 bg-white">
      @yield('left')
    </div>

    <!-- RIGHT: Cart Summary -->
    <div class="w-full lg:w-1/3 p-6 sm:p-8 bg-gradient-to-b from-pink-100 to-purple-200 rounded-t-3xl lg:rounded-tl-3xl lg:rounded-bl-3xl lg:rounded-tr-none lg:rounded-br-none">

      @yield('right')
    </div>
  </div>
</body>
</html>
