<x-app-layout>
    <div class="container flex flex-col justify-center min-h-screen">
        <div class="text-center text-4xl text-[#66FCF1] font-zen mb-5">
            <h3 class="mt-5">MOVIE REVIEW</h3>
        </div>
        <div class="bg-[#0B0C10] p-4 rounded-xl text-white flex flex-col relative">
            <h4 class="text-xl font-bold">{{ $review->movie->title }}</h4>

            <!-- Bookmark Button -->
            <form action="{{ route('bookmarks.store', $review) }}" method="POST" class="absolute top-4 right-4">
                @csrf
                <button type="submit" class="text-[#66FCF1] bg-[#1B263B] rounded-md px-3 py-1 hover:bg-[#57B7C6] focus:outline-none">
                    Bookmark
                </button>
            </form>


            <div class="flex flex-row gap-4">
                <img src="{{ asset('storage/' . $review->movie->image) }}" alt="{{ $review->movie->title }} Image" class="mb-2 max-w-full max-h-72" style="max-width: 500px; max-height: 300px;">
                <div class="flex flex-col gap-5">
                    <p><strong>Description:</strong></p>
                    <p>{{ $review->movie->description }}</p>
                    <p><strong>Release Date:</strong> {{ \Carbon\Carbon::parse($review->movie->release_date)->format('d M Y') }}</p>
                </div>
            </div>

            <div class="max-w-auto mt-10">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Discussion ({{ $review->comments->count() }})</h2>
                </div>
                <form action="{{ route('comments.store', $review) }}" method="POST" class="mb-6">
                    @csrf
                    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea id="comment" name="comment" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Write a comment..." required></textarea>
                    </div>
                    <button type="submit"
                        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white dark:placeholder-gray-400 dark:bg-gray-800 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-[#57B7C6]">
                        Post comment
                    </button>
                </form>

                @foreach ($review->comments as $comment)
                    @if (!$comment->parent_id) <!-- Check if the comment is not a reply -->
                        <article class="p-6 mb-3 text-base bg-white rounded-lg dark:bg-gray-900">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                        {{ $comment->user->name }}
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <time pubdate datetime="{{ $comment->created_at }}" title="{{ $comment->created_at }}">{{ \Carbon\Carbon::parse($comment->created_at)->format('d M Y') }}</time>
                                    </p>
                                </div>
                                <!-- Delete Button -->
                                <form action="{{ route('comments.destroy', [$review, $comment]) }}" method="POST" class="inline-flex">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this comment?');" class="text-red-600 hover:text-red-800 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">{{ $comment->content }}</p>
                            <div class="flex items-center mt-4 space-x-4">
                                <button type="button" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium" onclick="toggleReplyForm('replyForm{{ $comment->id }}')">
                                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                                    </svg>
                                    Reply
                                </button>
                            </div>

                            <div class="flex items-center mt-4 space-x-4">
                                <form action="{{ route('comments.like', $comment) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                                        <span>👍</span> Like ({{ $comment->likes_count }})
                                    </button>
                                </form>
                                <button type="button" class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium" onclick="toggleReplyForm('replyForm{{ $comment->id }}')">
                                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z"/>
                                    </svg>
                                    Reply
                                </button>
                            </div>

                            <!-- Reply Form -->
                            <form id="replyForm{{ $comment->id }}" action="{{ route('comments.reply', [$review, $comment]) }}" method="POST" class="hidden mt-4">
                                @csrf
                                <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                                    <label for="reply" class="sr-only">Your reply</label>
                                    <textarea id="reply" name="reply" rows="3"
                                        class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                                        placeholder="Write a reply..." required></textarea>
                                </div>
                                <button type="submit"
                                    class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white dark:placeholder-gray-400 dark:bg-gray-800 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-[#57B7C6]">
                                    Post reply
                                </button>
                            </form>

                            <!-- Display Replies -->
                            @foreach ($comment->replies as $reply)
                                <div class="ml-4 mt-3 p-4 bg-gray-100 rounded-lg dark:bg-gray-800">
                                    <p class="font-semibold text-sm">{{ $reply->user->name }}</p>
                                    <p class="text-gray-700 dark:text-gray-300">{{ $reply->content }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        <time pubdate datetime="{{ $reply->created_at }}" title="{{ $reply->created_at }}">{{ \Carbon\Carbon::parse($reply->created_at)->format('d M Y') }}</time>
                                    </p>
                                </div>
                            @endforeach 
                        </article>
                    @endif
                @endforeach

            </div>
        </div>
    </div>

    <script>
    function toggleReplyForm(formId) {
        const form = document.getElementById(formId);
        form.classList.toggle('hidden');
    }
</script>
</x-app-layout>
