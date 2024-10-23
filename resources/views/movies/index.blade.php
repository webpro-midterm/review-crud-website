<x-app-layout class="container flex flex-col items-center">
    <div class="container flex flex-col items-center">
        <h1 class="text-4xl mb-5">Movies</h1>

        <div class="bg-[#2F4156] text-white rounded px-1 py-1 transition-opacity duration-300 hover:opacity-70">
            <a href="{{ route('movies.create') }}" class="btn btn-primary mb-4">
                Add New Movie</a>
        </div>

        <div class="mt-5 bg-slate-400 rounded min-w-72">
            <div class="px-3.5 py-3.5">
                <ul mt-5 mb-5>
                    @foreach ($movies as $movie)
                    <div class="mb-5 bg-[#2F4156] bg-opacity-50 px-5 py-5 text-white">
                        <li class="flex flex-col items-center justify-center">
                            <!-- Display Movie Image -->
                            @if ($movie->image)
                                <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="mb-2" style="max-width: 200px;">
                            @endif

                            <!-- Movie details -->
                            <a href="{{ route('movies.show', $movie->id) }}">{{ $movie->title }}</a>
                            ({{ $movie->release_date }})

                            <!-- Action buttons for Edit and Delete -->
                            <div class="mt-2">
                                <!-- Edit button -->
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-secondary bg-[#2F4156] text-white px-0.5 py-0.5 rounded">
                                    Edit
                                </a>
                            </div>
                        </li>
                    </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
