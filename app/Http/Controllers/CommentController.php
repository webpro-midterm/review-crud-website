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
            'comment' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:comments,id', // Validates parent_id if provided
        ]);

        // If parent_id is not provided, create a top-level comment
        if (!$request->has('parent_id')) {
            $comment = new Comment();
            $comment->content = $request->input('comment');
            $comment->review_id = $review->id; // Associate with the specific review
            $comment->user_id = auth()->id(); // Get the authenticated user ID
            $comment->save();
        } else {
            // If parent_id is provided, treat it as a reply
            $comment = new Comment();
            $comment->content = $request->input('comment');
            $comment->review_id = $review->id; // Associate with the specific review
            $comment->user_id = auth()->id(); // Get the authenticated user ID
            $comment->parent_id = $request->input('parent_id'); // Set parent_id to relate it to the parent comment
            $comment->save();
        }

        return redirect()->back(); // Redirect back to the previous page
    }



    public function reply(Request $request, Review $review, Comment $comment)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $reply = new Comment();
        $reply->content = $request->input('reply');
        $reply->review_id = $review->id;
        $reply->user_id = auth()->id();
        $reply->parent_id = $comment->id; // Set the parent ID
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

    public function like(Request $request, Comment $comment)
    {
        $userId = auth()->id();

        // Check if the user already liked the comment
        $liked = $comment->likes()->where('user_id', $userId)->exists();

        if ($liked) {
            // User is unliking the comment
            $comment->decrement('likes_count');
            $comment->likes()->detach($userId); // Remove the like from the likes table
        } else {
            // User is liking the comment
            $comment->increment('likes_count');
            $comment->likes()->attach($userId, ['comment_id' => $comment->id]); // Add the like to the likes table
        }

        return redirect()->back();
    }


}

