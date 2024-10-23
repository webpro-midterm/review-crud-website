<x-app-layout>
    <div class="container">
        <h1>{{ $movie->title }}</h1>
        <p>{{ $movie->description }}</p>
        <p>Release Date: {{ $movie->release_date }}</p>

        <h2>Reviews</h2>
        <ul>
            @foreach ($movie->reviews as $review)
                <li>{{ $review->user->name }}: {{ $review->rating }} - {{ $review->review }}</li>
            @endforeach
        </ul>

        @auth
            <form action="{{ route('reviews.store', $movie->id) }}" method="POST">
                @csrf
                <label for="rating">Rating</label>
                <input type="number" name="rating" id="rating" class="form-control" max="5" min="1">
                <label for="review">Review</label>
                <textarea name="review" id="review" class="form-control"></textarea>
                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        @endauth
    </div>
</x-app-layout>
