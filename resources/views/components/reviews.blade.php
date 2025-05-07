<section class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded-xl p-6 shadow-md">
        <h2 class="text-left text-[#2E1B5F] font-extrabold text-2xl mb-6">
            Customer Reviews
        </h2>

        <div class="flex flex-col md:flex-row md:space-x-12">
            <!-- Rating Summary -->
            <div class="flex-1 bg-purple-100 rounded-lg p-6 mb-8 md:mb-0">
                <div class="flex flex-col items-center justify-center space-y-2 mb-2">
                    <span class="text-4xl font-bold text-purple-700 mb-4">
                        4.3
                    </span>
                    <div class="flex space-x-1 text-purple-700 text-lg">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                <p class="text-center text-purple-700 font-semibold">
                    55 Ratings
                </p>
            </div>
            
            <!-- Rating Distribution -->
            <div class="flex-1">
                <div class="space-y-4 text-sm text-gray-600">
                    @foreach([
                        ['rating' => '5.0', 'count' => 36, 'width' => '115px'],
                        ['rating' => '4.0', 'count' => 30, 'width' => '96px'],
                        ['rating' => '3.0', 'count' => 27, 'width' => '86px'],
                        ['rating' => '2.0', 'count' => 8, 'width' => '25px'],
                        ['rating' => '1.0', 'count' => 2, 'width' => '6px']
                    ] as $ratingData)
                    <div class="flex items-center justify-between">
                        <span>{{ $ratingData['rating'] }}</span>
                        <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-purple-700 rounded-full" style="width: {{ $ratingData['width'] }}"></div>
                        </div>
                        <span>{{ $ratingData['count'] }}</span>
                    </div>
                    @endforeach