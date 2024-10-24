<x-app-layout>
    <div class="container flex flex-col items-center">
        <h1 class="text-4xl mb-5 text-[#FFBF18] font-bold">Movies</h1>

        <div class="bg-[#2F4156] text-white rounded px-1 py-1 transition-opacity duration-300 hover:opacity-70">
            <a href="{{ route('movies.create') }}" class="btn btn-primary mb-4">
                Add New Movie</a>
        </div>

        <div class="mt-5 rounded mb-10">
            <div class="px-3.5 py-3.5">
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach ($movies as $movie)
                    <li class="mb-5 bg-[#374785] bg-opacity-50 px-5 py-5 text-white rounded">
                        <div class="flex flex-col items-center justify-center">
                            <!-- Display Movie Image -->
                            @if ($movie->image)
                                <img src="{{ asset('storage/' . $movie->image) }}" alt="{{ $movie->title }}" class="mb-2 min-h-5 min-w-5" style="max-width: 200px; max-height: 200px;">
                            @endif

                            <!-- Movie details -->
                            <a href="{{ route('movies.show', $movie->id) }}" class="text-xl">{{ $movie->title }}</a>
                            <span>({{ $movie->release_date }})</span>

                            <!-- Action buttons for Edit -->
                            <div class="mt-2 transition-opacity duration-300 hover:opacity-70">
                                <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-secondary bg-[#2F4156] text-white px-2 py-1 rounded">
                                    Edit
                                </a>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
