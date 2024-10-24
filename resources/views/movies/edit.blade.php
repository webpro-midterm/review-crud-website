<x-app-layout>
    <div class="container flex flex-col justify-center items-center">

        <div class="text-[#FFBF18] text-2xl font-bold p-5">
            <h1>Edit Movie</h1>
        </div>
        <!-- Form to update the movie -->

        <div class="bg-[#403c8f] p-5 rounded-xl">
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col justify-start"> <!-- Added enctype -->
                @csrf
                @method('PUT') <!-- This defines it as an update request -->

                <div class="mb-4 flex flex-col ">
                    <label for="title" class="form-label text-white">Title</label>
                    <input type="text" id="title" name="title" value="{{ $movie->title }}" class="form-control">
                </div>

                <div class="mb-4 flex flex-col ">
                    <label for="description" class="form-label text-white">Description</label>
                    <textarea id="description" name="description" class="form-control">{{ $movie->description }}</textarea>
                </div>

                <div class="mb-4 flex flex-col ">
                    <label for="release_date" class="form-label text-white">Release Date</label>
                    <input type="date" id="release_date" name="release_date" value="{{ $movie->release_date }}" class="form-control">
                </div>

                <div class="mb-4 flex-flex-col text-white">
                    <label for="image" class="form-label">Movie Image</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*"> <!-- Added accept attribute -->
                </div>

                <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit mt-5 transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                    Update Movie
                </button>

                <!-- Delete form -->


            </form>

            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                    @csrf
                    @method('DELETE') <!-- This defines it as a delete request -->
                    <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                        Delete Movie
                    </button>
            </form>
        </div>
    </div>
</x-app-layout>
