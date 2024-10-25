<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController; // Ensure this is included
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BookmarkController;

// Delete comments
Route::delete('/reviews/{review}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::post('comments/{comment}/like', [CommentController::class, 'like'])->name('comments.like');

// Reply to a comment
Route::post('/reviews/{review}/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');

// Store a new comment
Route::post('/reviews/{review}/comments', [CommentController::class, 'store'])->name('comments.store');

// Store a new bookmark for reviews
Route::post('/reviews/{review}/bookmarks', [BookmarkController::class, 'store'])->name('bookmarks.store');
// Delete a bookmark by ID
Route::delete('/bookmarks/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmarks.destroy');

Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');


// Resource routes for categories
Route::resource('categories', CategoryController::class);

// Display all reviews on the reviews index page
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
// Display a single review on click
Route::get('/reviews/{review}', [ReviewController::class, 'show'])->name('reviews.show');

// Display all movies
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index'); // <-- Add this line
Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

// Home route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route with middleware
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication middleware group
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Store a new review for movies
    Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    // Delete a review for movies
    Route::delete('/movies/{movie}/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Like a review
Route::post('/reviews/{review}/like', [ReviewController::class, 'like'])->name('reviews.like');

// Require authentication routes
require __DIR__.'/auth.php';
