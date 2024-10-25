<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'review_id',
        'content',
        'parent_id', 
        'likes_count',
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

    public function replies() {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function parent() {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    // Define the likes relationship
    public function likes() {
        return $this->belongsToMany(User::class, 'likes')->withTimestamps();
    }
}
