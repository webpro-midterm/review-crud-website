<x-app-layout>
    <h3>Comments</h3>
    @foreach ($review->comments as $comment)
        <div class="flex flex-col bg-gray-500 text-white">
            <strong>{{ $comment->user->name }}</strong>
            <p>{{ $comment->comment }}</p>
        </div>
    @endforeach

    <form action="{{ route('comments.store', $review) }}" method="POST">
        @csrf
        <div>
            <textarea name="comment" required></textarea>
        </div>
        <button type="submit">Post Comment</button>
    </form>
</x-app-layout>
