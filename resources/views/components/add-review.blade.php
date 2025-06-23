<div>
    <h3 class="font-semibold text-gray-700 text-xl mb-4">
        Add a Review
    </h3>
    <form class="space-y-4">
        <div>
            <label for="rating" class="block text-sm font-semibold text-gray-700 mb-1">
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
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">
                Name
            </label>
            <input
                id="name"
                name="name"
                type="text"
                placeholder="Your name"
                class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300"
            />
        </div>

        <div>
            <label for="review" class="block text-sm font-semibold text-gray-700 mb-1">
                Write Your Review
            </label>
            <textarea
                id="review"
                name="review"
                placeholder="Great"
                rows="3"
                class="w-full border border-purple-300 rounded-md px-3 py-2 text-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-300 resize-none"
            ></textarea>
        </div>

        <button
            type="submit"
            class="w-full bg-purple-700 text-white py-2 rounded-md font-semibold hover:bg-purple-800"
        >
            Submit
        </button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stars = document.querySelectorAll('#rating i');
        const ratingValue = document.getElementById('rating-value');
        let selectedRating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => highlightStars(index + 1));
            star.addEventListener('mouseleave', () => highlightStars(selectedRating));
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
