<x-app-layout>
    <div class="container">
        <h1 class="text-2xl text-center text-[#FFBF18] font-bold">Add Movie</h1>
        <div class="flex justify-center mt-10">
            <div class="bg-[#403c8f] bg-opacity-80 text-white p-5 max-w-4xl rounded-xl">

                <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col"> <!-- Added enctype -->
                    @csrf
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">

                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>

                    <label for="release_date">Release Date</label>
                    <input type="date" name="release_date" id="release_date" class="form-control">

                    <div class="mt-7">
                        <label for="image" class="form-label">Movie Image</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*"> <!-- Added accept attribute -->
                    </div>

                    <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit mt-5 transition-opacity duration-300 hover:opacity-70 p-1 rounded">Add Movie</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
