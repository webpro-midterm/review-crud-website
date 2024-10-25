<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Review; // Ensure you import the Review model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store(Request $request, Review $review)
    {
        $request->validate([
            'review_id' => 'required|exists:reviews,id', // Validation for review_id
        ]);

        $bookmark = new Bookmark();
        $bookmark->user_id = auth()->id(); // or however you get the user ID
        $bookmark->review_id = $request->input('review_id');
        $bookmark->movie_id = $review->movie->id; // If you also need to store the movie_id
        $bookmark->save();

        return redirect()->back()->with('success', 'Review bookmarked successfully.');
    }

    public function index()
    {
        // Fetch bookmarks for the authenticated user
        $bookmarkedReviews = Bookmark::with('review.movie')->where('user_id', auth()->id())->get();

        return view('bookmarks.index', compact('bookmarkedReviews'));
    }

}
