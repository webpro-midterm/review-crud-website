<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review_id',
        'content',  // Make sure this matches your migration
        'parent_id', // This allows replies to comments
    ];

    public function review() {
        return $this->belongsTo(Review::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bookmarks() {
        return $this->hasMany(Bookmark::class);
    }

    // Relationship to get replies to this comment
    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // Relationship to get the parent comment (if it exists)
    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }
}
