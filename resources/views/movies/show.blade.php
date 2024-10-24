<x-app-layout>
    <div class="flex flex-col">
        <h1 class="text-[#FFBF18] text-center text-3xl font-bold p-5">Submit Review</h1>
        <div class="container bg-[#403c8f] flex flex-col justify-start p-5 rounded-xl">
            <div class="mb-3">
                <h1 class="text-white text-2xl font-bold">{{ $movie->title }}</h1>
            </div>

            <div class="mb-3">
                <h1 class="text-white">Description</h1>
                <div class="bg-white max-w-fit p-1">
                    <p>{{ $movie->description }}</p>
                </div>

            </div>

            <div class="mb-2">
                <p class="text-white">Release Date: {{ $movie->release_date }}</p>
            </div>

            <div class="text-white">
                <h2>Reviews</h2>
                <ul>
                    @foreach ($movie->reviews as $review)
                        <li>{{ $review->user->name }}: {{ $review->rating }} - {{ $review->review }}</li>
                    @endforeach
                </ul>
            </div>
            @auth
                <form action="{{ route('reviews.store', $movie->id) }}" method="POST" class="flex flex-col">
                    @csrf
                    <label for="rating" class="text-white">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" max="5" min="1">
                    <label for="review" class="text-white">Review</label>
                    <textarea name="review" id="review" class="form-control"></textarea>
                    <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit mt-5 transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                        Submit Review
                    </button>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
