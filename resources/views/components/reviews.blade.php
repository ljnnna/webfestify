<!-- Customer Reviews -->
<section class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded p-6">
        <h2 class="text-left text-[#2E1B5F] font-extrabold text-2xl mb-6">
            Customer Reviews
        </h2>

        <div class="flex flex-col md:flex-row md:space-x-12">
            <!-- Left Panel: Rating Summary -->
            <div class="flex-1 bg-purple-100 rounded-lg p-6 mb-8 md:mb-0">
                <div class="flex flex-col items-center justify-center space-y-2 mb-2">
                    <span class="text-4xl font-bold text-purple-700 mb-4">
                        {{ number_format($averageRating ?? 0, 1) }}
                    </span>
                    <div class="flex space-x-2 text-purple-700 text-lg">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= round($averageRating))
                                <i class="fas fa-star"></i>
                            @elseif ($i - $averageRating <= 0.5)
                                <i class="fas fa-star-half-alt"></i>
                            @else
                                <i class="far fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <p class="text-center text-purple-700 font-semibold">
                    {{ $totalRatings }} Ratings
                </p>
            </div>

            <!-- Right Panel: Star Distribution -->
            <div class="flex-1">
                <div class="space-y-4 text-sm text-gray-600">
                    @for ($i = 5; $i >= 1; $i--)
                        @php
                            $count = $ratingsCount[$i] ?? 0;
                            $percent = $totalRatings > 0 ? ($count / $totalRatings) * 100 : 0;
                        @endphp
                        <div class="flex items-center justify-between">
                            <span> {{ $i }}.0 </span>
                            <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                                <div class="h-2 bg-purple-700 rounded-full" style="width: {{ $percent }}%"></div>
                            </div>
                            <span> {{ $count }} </span>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <!-- Feedback List -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-700 text-xl mb-4">
                    Recent Feedbacks
                </h3>
                <div class="space-y-6">
                    @forelse($reviews as $review)
                        <div class="flex space-x-4">
                        <img alt="Profile picture of {{ $review->user->name }}"
                             class="w-8 h-8 rounded-full object-cover border border-purple-300"
                             src="{{ $review->user->profile_photo 
                                ? asset('storage/' . $review->user->profile_photo) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) }}"
                            width="32" height="32" />
                            <div>
                                <p class="font-semibold text-purple-700">
                                    {{ $review->user->name }}
                                </p>
                                <p class="text-gray-600 text-sm mb-1">
                                    {{ $review->review ?? 'No comment provided.' }}
                                </p>
                                <div class="text-purple-700 text-sm">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rating)
                                            <i class="fas fa-star"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500">No reviews yet for this product.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
