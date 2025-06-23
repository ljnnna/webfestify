<div>
    <h3 class="font-semibold text-gray-700 text-xl mb-4">
        Add a Review
    </h3>

    <form method="POST" action="{{ route('review.store') }}" class="space-y-4">
        @csrf

        {{-- Hidden Inputs --}}
        <input type="hidden" name="rental_item_id" value="{{ $rentalItem->id }}">
        <input type="hidden" name="product_id" value="{{ $rentalItem->product->id }}">
        <input type="hidden" name="rating" id="rating-value-{{ $rentalItem->id }}" value="0" />

        {{-- Rating --}}
        <div>
            <label for="rating-{{ $rentalItem->id }}" class="block text-sm font-semibold text-gray-700 mb-1">
                Add Your Rating
            </label>
            <div id="rating-{{ $rentalItem->id }}" class="flex space-x-1 text-purple-700 text-2xl cursor-pointer rating-stars">
                <i class="far fa-star" data-value="1"></i>
                <i class="far fa-star" data-value="2"></i>
                <i class="far fa-star" data-value="3"></i>
                <i class="far fa-star" data-value="4"></i>
                <i class="far fa-star" data-value="5"></i>
            </div>
        </div>

        {{-- Comment --}}
        <div>
            <label for="review" class="block text-sm font-semibold text-gray-700 mb-1">
                Write Your Review
            </label>
            <textarea
                name="comment"
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
    const ratingSections = document.querySelectorAll('.rating-stars');

    ratingSections.forEach(section => {
        const stars = section.querySelectorAll('i');
        const ratingInputId = 'rating-value-' + section.id.split('rating-')[1];
        const ratingInput = document.getElementById(ratingInputId);
        let selectedRating = 0;

        stars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => highlightStars(index + 1, stars));
            star.addEventListener('mouseleave', () => highlightStars(selectedRating, stars));
            star.addEventListener('click', () => {
                selectedRating = index + 1;
                ratingInput.value = selectedRating;
                highlightStars(selectedRating, stars);
                console.log(`Rating (${section.id}):`, selectedRating);
            });
        });
    });

    function highlightStars(rating, stars) {
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
