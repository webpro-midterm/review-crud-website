<x-app-layout>
    <div>
        <div class="container">
            <div class="text-4xl mb-4 text-center text-[#FFBF18] font-bold p-5">
                <h1>All Reviews</h1>
            </div>

            <div class="grid grid-cols-3 gap-2 mx-5">
                @if($reviews->isEmpty())
                    <p>No reviews available.</p>
                @else
                    @foreach($reviews as $review)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <a href="{{ route('reviews.show', $review) }}" class="block">
                                <div class="max-w-sm border border-gray-200 rounded-lg shadow bg-[#2F4156] text-white flex flex-col items-center">
                                    <div class="p-5">
                                        @if($review->movie->image)
                                            <img src="{{ asset('storage/' . $review->movie->image) }}" class="card-img-top" alt="{{ $review->movie->title }} Image" style="max-height: 200px; object-fit: cover;">
                                        @else
                                            <img src="https://via.placeholder.com/400x200" class="card-img-top" alt="No Image" style="max-height: 200px; object-fit: cover;">
                                        @endif
                                        <div class="card-body p-5">
                                            <h5 class="card-title mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $review->movie->title }}</h5>
                                            <p class="card-text">{{ Str::limit($review->review, 100) }}</p>
                                            <p class="card-text">Rating: {{ $review->rating }}/5</p>
                                            <span class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg">Read More</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
