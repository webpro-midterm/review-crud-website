<x-app-layout>
    <div class="container flex flex-col justify-center items-center">
        <div class="text-[#66FCF1] text-2xl font-bold p-5">
            <h1>Edit Movie</h1>
        </div>

        <div class="bg-[#0B0C10] p-5 rounded-xl">
            <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col justify-start">
                @csrf
                @method('PUT')

                <div class="flex flex-row">
                    <div class="mb-4 flex flex-col text-white p-5">
                        <label for="image" class="form-label">Movie Image</label>
                        <div id="image-frame" class="w-32 h-32 bg-gray-800 rounded-lg flex items-center justify-center cursor-pointer">
                            <img id="image-preview" src="{{ asset('storage/' . $movie->image) }}" alt="Image Preview" class="hidden w-full h-full object-cover rounded-lg" />
                            <span id="image-placeholder" class="text-gray-400">Click to upload image</span>
                            <input type="file" id="image" name="image" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </div>
                    </div>

                    <div class="">
                        <div class="mb-4 flex flex-col">
                            <label for="title" class="form-label text-white">Title</label>
                            <input type="text" id="title" name="title" value="{{ $movie->title }}" class="form-control">
                        </div>

                        <div class="mb-4 flex flex-col">
                            <label for="description" class="form-label text-white">Description</label>
                            <textarea id="description" name="description" class="form-control">{{ $movie->description }}</textarea>
                        </div>

                        <div class="mb-4 flex flex-col">
                            <label for="release_date" class="form-label text-white">Release Date</label>
                            <input type="date" id="release_date" name="release_date" value="{{ $movie->release_date }}" class="form-control">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit mt-5 transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                    Update Movie
                </button>
            </form>

            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-primary bg-slate-500 max-w-fit transition-opacity duration-300 hover:opacity-70 p-1 rounded text-white">
                    Delete Movie
                </button>
            </form>
        </div>
    </div>

    <script>
        // Function to preview the selected image
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            const imageFrame = document.getElementById('image-frame');
            const imagePreview = document.getElementById('image-preview');
            const imagePlaceholder = document.getElementById('image-placeholder');

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.classList.remove('hidden');
                imagePlaceholder.classList.add('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        // Click event to trigger the file input
        document.getElementById('image-frame').addEventListener('click', function() {
            document.getElementById('image').click();
        });
    </script>
</x-app-layout>
