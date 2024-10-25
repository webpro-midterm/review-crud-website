<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;
use App\Models\Review;

Route::post('reviews/{review}/bookmarks', [BookmarkController::class, 'store'])->name('bookmark.store');
Route::delete('bookmarks/{id}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');

Route::resource('categories', CategoryController::class);

// Display all reviews on the reviews index page
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
//Display single review on click
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('movies', MovieController::class);

Route::middleware(['auth'])->group(function () {
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/movies/{movie}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

Route::post('/reviews/{review}/like', [ReviewController::class, 'like'])->name('reviews.like');
Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::post('/comments/{comment}/bookmark', [BookmarkController::class, 'store'])->name('bookmarks.store');
Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

require __DIR__.'/auth.php';
