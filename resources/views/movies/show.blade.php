<x-app-layout>
    <div class="flex flex-col">
        <h1 class="text-[#66FCF1] text-center text-3xl font-bold font-zen p-5">SUBMIT REVIEW</h1>
        <div class="container bg-[#0B0C10] flex flex-col justify-start p-5 rounded-xl">
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
                        <li>
                            {{ $review->user->name }}: {{ $review->rating }} - {{ $review->review }}

                            <!-- Display Comments for each Review -->
                            <div class="mt-2">
                                <h3 class="text-white">Comments:</h3>
                                <ul>
                                    @foreach ($review->comments as $comment)
                                        <li>
                                            {{ $comment->user->name }}: {{ $comment->comment }}
                                            <!-- Reply Form -->
                                            <form id="replyForm{{ $comment->id }}" action="{{ route('comments.store', $review) }}" method="POST" class="hidden mt-4">
                                                @csrf
                                                <input type="hidden" name="review_id" value="{{ $review->id }}">
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}"> <!-- For replies -->
                                                <textarea name="comment" class="form-control" required></textarea>
                                                <button type="submit" class="btn btn-primary bg-slate-500 mt-1 transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                                                    Reply
                                                </button>
                                            </form>
                                            <!-- Display Replies -->
                                            @if ($comment->replies)
                                                <div class="ml-4">
                                                    @foreach ($comment->replies as $reply)
                                                        <div>
                                                            {{ $reply->user->name }}: {{ $reply->comment }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            @auth
                <form action="{{ route('reviews.store', $movie->id) }}" method="POST" class="flex flex-col mt-5">
                    @csrf
                    <label for="rating" class="text-white">Rating</label>
                    <input type="number" name="rating" id="rating" class="form-control" max="5" min="1" required>
                    <label for="review" class="text-white">Review</label>
                    <textarea name="review" id="review" class="form-control" required></textarea>
                    <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit mt-5 transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                        Submit Review
                    </button>
                </form>
            @endauth
        </div>
    </div>
</x-app-layout>
