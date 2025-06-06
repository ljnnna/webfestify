<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1" name="viewport"/>
  <title>
   Festify
  </title>
  <script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class',
  }
</script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
      font-family: "Inter", sans-serif;
    }
  </style>
 </head>
 <body class="bg-white text-[#3E3667] dark:bg-[#1E1B2E] dark:text-white">

    <!-- Header -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content') 
    </main>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
