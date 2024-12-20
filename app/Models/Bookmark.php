<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Bookmark extends Model {
  use HasFactory;
  
  protected $fillable = [
    'user_id',
    'comment_id',
  ];

  public function user(){
    return $this->belongsTo(User::class);
  }

  public function comment(){
    return $this->belongsTo(Comment::class);
  }

}
