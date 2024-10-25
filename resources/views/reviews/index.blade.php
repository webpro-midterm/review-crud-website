<x-app-layout>
    <div>
        <div class="container">
            <div class="text-4xl mb-4 text-center text-[#66FCF1] font-bold p-5 font-zen">
                <h1>REVIEWS</h1>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mx-5">
                @if($reviews->isEmpty())
                    <p>No reviews available.</p>
                @else
                    @foreach($reviews as $review)
                        <div class="m-4 w-auto px-4">
                            <div class="rounded-lg bg-[#2F4156] shadow-lg">
                                @if($review->movie->image)
                                    <img src="{{ asset('storage/' . $review->movie->image) }}"
                                         alt="{{ $review->movie->title }} Image"
                                         class="rounded-t-lg object-cover h-64 w-full">
                                @else
                                    <img src="https://via.placeholder.com/400x500"
                                         alt="No Image"
                                         class="rounded-t-lg object-cover h-64 w-full">
                                @endif
                                <div class="p-4 text-white">
                                    <h2 class="mb-2 text-lg font-semibold">{{ $review->movie->title }}</h2>
                                    <p class="mb-2 text-sm">Release Date: {{ $review->movie->release_date }}</p>
                                    <p class="mb-4 text-sm">{{ Str::limit($review->review, 100) }}</p>
                                    <p class="mb-4 text-sm">Rating: {{ $review->rating }}/5</p>
                                    <a href="{{ route('reviews.show', $review) }}"
                                       class="block rounded-lg bg-blue-500 px-4 py-2 text-center font-semibold text-white hover:bg-blue-600">
                                        Read More
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
