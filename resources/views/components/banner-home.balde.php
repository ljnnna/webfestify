<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Swiper Main Slider -->
    <div class="md:col-span-2">
        <div class="swiper promo-swiper rounded-lg overflow-hidden">
            <div class="swiper-wrapper">
                <!-- Slide 1 -->
                <div class="swiper-slide">
                    <img src="https://cf.shopee.co.id/file/id-50009109-3d6e10cb4ed30f6d6de6b06c2f43e1a9_xxhdpi" class="w-full h-full object-cover" alt="Promo 1">
                </div>
                <!-- Slide 2 -->
                <div class="swiper-slide">
                    <img src="https://cf.shopee.co.id/file/id-50009109-06fadd40a3f0ef307e2e3773e88d05ae_xxhdpi" class="w-full h-full object-cover" alt="Promo 2">
                </div>
                <!-- Slide 3 -->
                <div class="swiper-slide">
                    <img src="https://cf.shopee.co.id/file/id-50009109-83b740c6cce8e02ffda0701e7981f6bb_xxhdpi" class="w-full h-full object-cover" alt="Promo 3">
                </div>
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <!-- Side Banners -->
    <div class="flex flex-col gap-4">
        <img src="https://cf.shopee.co.id/file/id-50009109-2d8312d6e7615be051d4bdfd2375fd11_xxhdpi" class="w-full rounded-lg object-cover" alt="Side 1">
        <img src="https://cf.shopee.co.id/file/id-50009109-4d27b4c81603c1b924a86dfe7f671227_xxhdpi" class="w-full rounded-lg object-cover" alt="Side 2">
    </div>
</div>

<!-- SwiperJS CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Swiper Init Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Swiper('.promo-swiper', {
            loop: true,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    });
</script>
