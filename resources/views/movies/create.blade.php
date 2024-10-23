<x-app-layout>
    <div class="container">
        <h1>Add Movie</h1>
        <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data"> <!-- Added enctype -->
            @csrf
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control">

            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>

            <label for="release_date">Release Date</label>
            <input type="date" name="release_date" id="release_date" class="form-control">

            <div class="mb-4">
                <label for="image" class="form-label">Movie Image</label>
                <input type="file" id="image" name="image" class="form-control" accept="image/*"> <!-- Added accept attribute -->
            </div>

            <button type="submit" class="btn btn-primary">Add Movie</button>
        </form>
    </div>
</x-app-layout>
