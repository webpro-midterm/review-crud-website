<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Review;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Review $review)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $comment = new Comment();
        $comment->review_id = $review->id;
        $comment->user_id = auth()->id(); // Assuming user authentication is set up
        $comment->content = $request->comment;
        $comment->save();

        return redirect()->route('reviews.show', $review)->with('success', 'Comment posted successfully.');
    }
}
