<!-- Customer Reviews -->
<section class="max-w-6xl mx-auto p-6">
    <div class="bg-white rounded p-6">
        <h2 class="text-left text-[#2E1B5F] font-extrabold text-2xl mb-6">
            Customer Reviews
        </h2>

        <div class="flex flex-col md:flex-row md:space-x-12">
            <div class="flex-1 bg-purple-100 rounded-lg p-6 mb-8 md:mb-0">
                <div class="flex flex-col items-center justify-center space-y-2 mb-2">
                    <span class="text-4xl font-bold text-purple-700 mb-4">
                        4.3
                    </span>
                    <div class="flex space-x-8 text-purple-700 text-lg">
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
            <div class="flex-1">
                <div class="space-y-4 text-sm text-gray-600">
                    <div class="flex items-center justify-between">
                        <span> 5.0 </span>
                        <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-purple-700 rounded-full" style="width: 115px"></div>
                        </div>
                        <span> 36 </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span> 4.0 </span>
                        <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-purple-700 rounded-full" style="width: 96px"></div>
                        </div>
                        <span> 30 </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span> 3.0 </span>
                        <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-purple-700 rounded-full" style="width: 86px"></div>
                        </div>
                        <span> 27 </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span> 2.0 </span>
                        <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-purple-700 rounded-full" style="width: 25px"></div>
                        </div>
                        <span> 8 </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span> 1.0 </span>
                        <div class="w-80 h-2 bg-purple-200 rounded-full overflow-hidden">
                            <div class="h-2 bg-purple-700 rounded-full" style="width: 6px"></div>
                        </div>
                        <span> 2 </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold text-gray-700 text-xl mb-4">
                    Recent Feedbacks
                </h3>
                <div class="space-y-6">
                    <div class="flex space-x-4">
                        <img alt="Profile picture of Issac Cassanova, male with short hair"
                            class="w-12 h-12 rounded-full object-cover" height="48"
                            src="https://storage.googleapis.com/a1aa/image/492c70e4-3bc6-418a-eee2-8c681d605608.jpg"
                            width="48" />
                        <div>
                            <p class="font-semibold text-purple-700">
                                Issac Cassanova
                            </p>
                            <p class="text-gray-600 text-sm mb-1">
                                Loved the lightstick! Worked perfectly and
                                looked nice. Smooth rental process!
                            </p>
                            <div class="text-purple-700 text-sm">
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                            </div>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <img alt="Profile picture of Snopia Elvira, female with long hair"
                            class="w-12 h-12 rounded-full object-cover" height="48"
                            src="https://storage.googleapis.com/a1aa/image/d62830be-2916-4583-6363-0f646094b15f.jpg"
                            width="48" />
                        <div>
                            <p class="font-semibold text-purple-700">
                                Snopia Elvira
                            </p>
                            <p class="text-gray-600 text-sm mb-1">
                                Great service, good quality lightstick, and no
                                hassle at all. Would rent again!
                            </p>
                            <div class="text-purple-700 text-sm">
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                                <i class="fas fa-star"> </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h3 class="font-semibold text-gray-700 text-xl mb-4">
                    Add a Review
                </h3>
                <form class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="rating">
                            Add Your Rating
                        </label>
                        <div id="rating" class="flex space-x-1 text-purple-700 text-2xl cursor-pointer">
                            <i class="far fa-star" data-value="1"></i>
                            <i class="far fa-star" data-value="2"></i>
                            <i class="far fa-star" data-value="3"></i>
                            <i class="far fa-star" data-value="4"></i>
                            <i class="far fa-star" data-value="5"></i>
                        </div>
                        <input type="hidden" name="rating" id="rating-value" value="0" />

                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="name">
                            Name
                        </label>
                        <input
                            class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300"
                            id="name" name="name" placeholder="Your name" type="text" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1" for="review">
                            Write Your Review
                        </label>
                        <textarea
                            class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300 resize-none"
                            id="review" name="review" placeholder="Great" rows="3"></textarea>
                    </div>
                    <button class="w-full bg-purple-700 text-white py-2 rounded-md font-semibold hover:bg-purple-800"
                        type="submit">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#rating i');
    const ratingValue = document.getElementById('rating-value');
    let selectedRating = 0;

    stars.forEach((star, index) => {
        // Hover effect
        star.addEventListener('mouseenter', () => highlightStars(index + 1));
        star.addEventListener('mouseleave', () => highlightStars(selectedRating));

        // Click event
        star.addEventListener('click', () => {
            selectedRating = index + 1;
            ratingValue.value = selectedRating;
            highlightStars(selectedRating);
            console.log('Rating set to:', selectedRating);
        });
    });

    function highlightStars(rating) {
        stars.forEach((star, i) => {
            if (i < rating) {
                star.classList.add('fas');
                star.classList.remove('far');
            } else {
                star.classList.remove('fas');
                star.classList.add('far');
            }
        });
    }
});
</script>