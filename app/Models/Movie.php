<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
  protected $fillable = ['title', 'description', 'release_date', 'image', 'user_id'];

  public function reviews() {
    return $this->hasMany(Review::class);
  }
}
