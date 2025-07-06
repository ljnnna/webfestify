<!-- Add Review -->
<div class="bg-white rounded-xl shadow-md p-6 border border-gray-100 mt-6">
    <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
        <span class="bg-yellow-100 text-yellow-600 p-2 rounded-full mr-3">
            <i class="fas fa-star text-sm"></i>
        </span>
        <span>Add Review</span>
    </h3>
    <p class="text-sm text-gray-600 mb-4">Tell us your experience before returning the product.</p>

    <form action="{{ route('returns.submitReview', $return->id) }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $return->product_id }}">

        <!-- Rating -->
        <div class="mb-4">
            <div class="flex justify-center space-x-1" id="rating-stars-{{ $return->id }}">
                @for($i = 1; $i <= 5; $i++)
                    <button type="button"
                        class="rating-star text-2xl text-gray-300 hover:text-yellow-400 focus:outline-none transition-colors"
                        data-rating="{{ $i }}">
                        <i class="fas fa-star"></i>
                    </button>
                @endfor
            </div>
            <input type="hidden" name="rating" id="rating-input-{{ $return->id }}" required>
        </div>

        <!-- Comment -->
        <div class="mb-4">
            <label for="review-{{ $return->id }}" class="block text-sm font-medium text-gray-700 mb-2">Your Review</label>
            <textarea name="review" id="review-{{ $return->id }}" rows="3"
                class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                placeholder="Tell us about your experience..."></textarea>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full bg-gradient-to-r from-yellow-500 to-orange-500 text-white py-2 px-4 rounded-lg font-medium hover:opacity-90 transition-opacity shadow-md">
            Submit Review & Return
        </button>
    </form>
</div>

<!-- Rating Stars Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const returnId = {{ $return->id }};
        const stars = document.querySelectorAll(`#rating-stars-${returnId} .rating-star`);
        const ratingInput = document.getElementById(`rating-input-${returnId}`);

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;

                stars.forEach((s, i) => {
                    if (i < rating) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            });

            star.addEventListener('mouseover', function () {
                const rating = this.getAttribute('data-rating');
                stars.forEach((s, i) => {
                    if (i < rating) {
                        s.classList.add('text-yellow-300');
                    }
                });
            });

            star.addEventListener('mouseout', function () {
                stars.forEach(s => s.classList.remove('text-yellow-300'));
                if (ratingInput.value) {
                    stars.forEach((s, i) => {
                        if (i < ratingInput.value) {
                            s.classList.add('text-yellow-400');
                        }
                    });
                }
            });
        });
    });
</script>