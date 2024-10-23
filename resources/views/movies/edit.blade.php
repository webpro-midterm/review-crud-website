<x-app-layout>
    <div class="container">
        <h1>Edit Movie</h1>

        <!-- Form to update the movie -->
        <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data"> <!-- Added enctype -->
            @csrf
            @method('PUT') <!-- This defines it as an update request -->

            <div class="mb-4">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" value="{{ $movie->title }}" class="form-control">
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control">{{ $movie->description }}</textarea>
            </div>

            <div class="mb-4">
                <label for="release_date" class="form-label">Release Date</label>
                <input type="date" id="release_date" name="release_date" value="{{ $movie->release_date }}" class="form-control">
            </div>

            <div class="mb-4">
                <label for="image" class="form-label">Movie Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*"> <!-- Added accept attribute -->
            </div>

            <button type="submit" class="btn btn-primary">Update Movie</button>
        </form>

        <!-- Delete form -->
        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to delete this movie?');">
            @csrf
            @method('DELETE') <!-- This defines it as a delete request -->
            <button type="submit" class="btn btn-danger">Delete Movie</button>
        </form>
    </div>
</x-app-layout>
