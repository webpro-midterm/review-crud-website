<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Review;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function store(Request $request, $reviewId)
    {
        // Validate the incoming request
        $request->validate([
            'user_id' => 'required|exists:users,id',
            // Add any other validation rules if necessary
        ]);

        // Create a new bookmark
        Bookmark::create([
            'user_id' => $request->user_id,
            'review_id' => $reviewId, // Ensure you're passing the review_id
        ]);

        return redirect()->back()->with('success', 'Bookmark added successfully!');
    }
}
