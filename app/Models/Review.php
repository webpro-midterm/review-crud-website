<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model {
  protected $fillable = ['movie_id', 'user_id', 'rating', 'review'];

  public function movie() {
    return $this->belongsTo(Movie::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
