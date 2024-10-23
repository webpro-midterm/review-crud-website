<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('movie')->get();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
        ]);

        $movie->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect()->route('movies.show', $movie);
    }

    public function destroy(Movie $movie, Review $review)
    {
        if ($review->user_id == auth()->id()) {
            $review->delete();
        }

        return redirect()->route('movies.show', $movie);
    }

    public function show($id)
    {
        // Fetch the review by ID
        $review = Review::findOrFail($id);

        // Fetch comments related to this review
        $comments = $review->comments; // Assuming you have a relationship defined

        return view('reviews.show', compact('review', 'comments'));
    }

    public function like(Review $review)
    {
        $review->likes()->create([
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('reviews.show', $review);
    }

}
