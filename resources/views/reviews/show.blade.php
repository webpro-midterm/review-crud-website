<x-app-layout>
    <div class="container">
        <h3 class="mt-5">Movie Details</h3>
        <div class="bg-gray-200 p-4 rounded">
            <h4 class="text-xl font-bold">{{ $review->movie->title }}</h4>
            <img src="{{ asset('storage/' . $review->movie->image) }}" alt="{{ $review->movie->title }} Image" class="mb-2 max-w-full max-h-72" style="max-width: 500px; max-height: 300px;">
            <p><strong>Description:</strong> {{ $review->movie->description }}</p>
            <p><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($review->movie->release_date)->format('d M Y') }}</p>
        </div>

        <h3>Comments</h3>
        @foreach ($review->comments as $comment)
            <div class="flex flex-col bg-gray-500 text-white mb-2 p-2 rounded">
                <strong>{{ $comment->user->name }}</strong>
                <p>{{ $comment->comment }}</p>
            </div>
        @endforeach

        <form action="{{ route('comments.store', $review) }}" method="POST">
            @csrf
            <div>
                <textarea name="comment" required class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>
    </div>
</x-app-layout>
