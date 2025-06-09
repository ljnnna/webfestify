<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'Panduan' }}</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>

  <style>
    body {
      background: linear-gradient(135deg, #e0caff, #fbd0ff, #fde6ff);
      font-family: 'Segoe UI', sans-serif;
    }
    .step {
      animation: fadeSlideUp 0.8s ease forwards;
      opacity: 0;
      transform: translateY(20px);
    }
    @keyframes fadeSlideUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body class="min-h-screen px-4 md:px-6 py-8 md:py-10 text-[#5a3a82]">
  {{ $slot }}
</body>
</html>
