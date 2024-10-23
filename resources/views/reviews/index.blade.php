<x-app-layout>
    <div class="container">
        <h1>All Reviews</h1>
        <ul>
            @foreach ($reviews as $review)
                <li>
                    {{ $review->user->name }} reviewed
                    <a href="{{ route('movies.show', $review->movie->id) }}">{{ $review->movie->title }}</a>:
                    {{ $review->rating }} stars
                    <p>{{ $review->review }}</p>
                </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
