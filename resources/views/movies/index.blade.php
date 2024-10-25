<x-app-layout>
    <div class="container flex flex-col items-center">
        <div class="bg-[#1F2833] p-5 rounded-2xl flex flex-col items-center">
            <h1 class="text-4xl mb-5 text-[#66FCF1] font-bold font-zen">POST</h1>
            <div class="bg-[#2F4156] text-white rounded px-1 py-1 transition-opacity duration-300 hover:opacity-70 max-w-fit max-h-fit">
                <a href="{{ route('movies.create') }}" class="btn btn-primary mb-4">Add New Movie</a>
            </div>
        </div>

        <div class=" flex items-center">
            <div class="mt-5 grid grid-cols-2 sm:grid-cols-4 gap-x-5 gap-y-5 p-5">
                @foreach ($movies as $movie)
                <div class="relative rounded-xl overflow-hidden">
                    @if ($movie->image)
                        <img src="{{ asset('storage/' . $movie->image) }}" class="object-cover h-full w-full -z-10" alt="{{ $movie->title }}">
                    @endif
                    <div class="absolute top-0 h-full w-full bg-gradient-to-t from-black/50 p-3 flex flex-col justify-between">
                        <div class="flex justify-between">
                            <div>
                                <!-- Optional: You can place the movie title here -->
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('movies.edit', $movie->id) }}" class="p-2.5 bg-gray-800/80 rounded-lg text-white hover:bg-red-600/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.586 9.586l5.828-5.828a2 2 0 112.828 2.828l-5.828 5.828H14a2 2 0 01-2 2v1.414l-4-4V10a2 2 0 012-2h1.414z" />
                                        <path fill-rule="evenodd" d="M5 3a1 1 0 000 2h2a1 1 0 100-2H5zm0 4a1 1 0 000 2h5a1 1 0 100-2H5zm0 4a1 1 0 000 2h5a1 1 0 100-2H5zm-2 4a1 1 0 100 2h7a1 1 0 100-2H3z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('movies.show', $movie->id) }}" class="p-2.5 bg-gray-800/80 rounded-lg text-white hover:bg-red-600/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="self-center flex flex-col items-center space-y-2">
                            <span class="capitalize text-white font-medium drop-shadow-md">{{ $movie->title }}</span>
                            <span class="text-gray-300 text-xs">({{ $movie->release_date }})</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
