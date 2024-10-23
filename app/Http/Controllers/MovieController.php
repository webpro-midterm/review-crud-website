<?php

namespace App\Http\Controllers;

use App\Models\Movie; // Import the Movie model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage facade

class MovieController extends Controller {

    // Display a listing of the movies
    public function index() {
        $movies = Movie::all(); // Fetch all movies from the database
        return view('movies.index', compact('movies')); // Pass movies to the view
    }

    // Show the form for creating a new movie
    public function create() {
        return view('movies.create'); // Display the form for creating a movie
    }

    // Store a newly created movie in the database
    public function store(Request $request) {
        $request->validate([ // Validate form input
            'title' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $movieData = $request->all();

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Store the image in the 'public/images' directory and get its path
            $imagePath = $request->file('image')->store('images', 'public');
            $movieData['image'] = $imagePath; // Save the image path in the movie data
        }

        Movie::create($movieData); // Create a new movie record in the database

        return redirect()->route('movies.index')->with('success', 'Movie created successfully'); // Redirect to the movie list
    }

    // Display the specified movie
    public function show(Movie $movie) { // The $movie will be automatically injected by route-model binding
        return view('movies.show', compact('movie')); // Pass the movie to the view
    }

    // Show the form for editing the specified movie
    public function edit(Movie $movie) { // The $movie will be automatically injected by route-model binding
        return view('movies.edit', compact('movie')); // Pass the movie to the view
    }

    // Update the specified movie in the database
    public function update(Request $request, Movie $movie) {
        $request->validate([ // Validate the form input
            'title' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        $movieData = $request->all();

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($movie->image) {
                Storage::disk('public')->delete($movie->image); // Delete old image
            }

            // Store the new image in the 'public/images' directory
            $imagePath = $request->file('image')->store('images', 'public');
            $movieData['image'] = $imagePath; // Save the new image path
        } else {
            $movieData['image'] = $movie->image; // Keep the old image if no new one is uploaded
        }

        $movie->update($movieData); // Update the movie record

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully'); // Redirect to the movie list
    }

    // Remove the specified movie from the database
    public function destroy(Movie $movie) {
        // Optionally delete the image from storage
        if ($movie->image) {
            Storage::disk('public')->delete($movie->image); // Delete image if it exists
        }

        $movie->delete(); // Delete the movie record
        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully'); // Redirect to the movie list
    }
}
