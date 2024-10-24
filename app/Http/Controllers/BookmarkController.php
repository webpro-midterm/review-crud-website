<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller {
  public function store() {
    $request->validate([
        'comment_id' => 'required|exists:comments,id',
    ]);

    Bookmark::create([
      'user_id' => Auth::id(),
      'comment_id' => $comment->id,
    ]);

    return redirect()->back()->with('success', 'Comment bookmarked you little shit!');
  }
  
  public function destroy(Bookmark $bookmark) {
    $bookmark->delete();
    return redirect()->back()->with('success', 'Bookmark removed!');
  }
}
