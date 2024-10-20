<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
  protected $fillable = ['title', 'description', 'release_date'];

  public function reviews() {
    return $this->hasMany(Review::class);
  }
}
