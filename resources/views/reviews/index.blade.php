<x-app-layout>
<div class="container">
    <h1>All Reviews</h1>

    <div class="row">
        @foreach($reviews as $review)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <!-- Check if the review has an image -->
                    @if($review->movie->image) <!-- Change to reference movie's image -->
                        <img src="{{ asset('storage/' . $review->movie->image) }}" class="card-img-top" alt="Review Image" style="max-height: 200px; object-fit: cover;">
                    @else
                        <!-- Default placeholder image if no image is uploaded -->
                        <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="No Image" style="max-height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $review->movie->title }}</h5>
                        <p class="card-text">{{ Str::limit($review->review, 100) }}</p>
                        <p class="card-text">Rating: {{ $review->rating }}/5</p>
                        <a href="{{ route('reviews.show', $review) }}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</x-app-layout>
