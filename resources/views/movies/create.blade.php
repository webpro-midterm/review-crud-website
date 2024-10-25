<x-app-layout>
    <div class="container">
        <h1 class="text-2xl text-center text-[#66FCF1] font-bold">ADD MOVIE</h1>
        <div class="flex justify-center mt-10">
            <div class="bg-[#0B0C10] bg-opacity-80 p-5 max-w-4xl rounded-xl">

                <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col"> <!-- Added enctype -->
                    @csrf
                    <div class="text-white">
                    <label for="title">Title</label>
                    </div>
                    <input type="text" name="title" id="title" class="form-control">

                    <div class="text-white">
                    <label for="description">Description</label>
                    </div>
                    <textarea name="description" id="description" class="form-control"></textarea>

                    <label for="release_date" class="text-white">Release Date</label>
                    <input type="date" name="release_date" id="release_date" class="form-control">

                    <div class="mt-7">
                        <label for="image" class="form-label text-white">Movie Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*"> <!-- Added accept attribute -->
                    </div>

                    <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit mt-5 transition-opacity duration-300 hover:opacity-70 p-1 rounded">Add Movie</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
