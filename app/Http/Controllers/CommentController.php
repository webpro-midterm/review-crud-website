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

    // New method to handle replies
    public function reply(Request $request, Review $review, Comment $comment)
    {
        $request->validate([
            'reply' => 'required|string|max:1000', // Validate the reply input
        ]);

        // Create a new reply comment
        $reply = new Comment();
        $reply->review_id = $review->id; // Associate the reply with the review
        $reply->user_id = auth()->id(); // Assuming the user is authenticated
        $reply->content = $request->input('reply'); // Store the reply content
        $reply->parent_id = $comment->id; // Set the parent comment ID for nesting
        $reply->save();

        return redirect()->route('reviews.show', $review)->with('success', 'Reply posted successfully.');
    }

    public function destroy(Review $review, Comment $comment)
    {
        // Optional: Check if the comment belongs to the review
        if ($comment->review_id !== $review->id) {
            return redirect()->route('reviews.show', $review)->with('error', 'Comment not found.');
        }

        // Delete the comment
        $comment->delete();

        return redirect()->route('reviews.show', $review)->with('success', 'Comment deleted successfully.');
    }
}

