<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller {

  public function index() { //retrieves all the movies in the database 
    $movies = Movie::all(); //Movies::all() means all movies
    return view('movies.index', compact('movies')); // compact() is function to creates an array containin all the movies variable in the DB
    // also this means that it's going to the index.blade.php
  } 

  public function create() {
    return view('movies.create'); // creating a movie
    /*
    basically movies.create is instruction the code to find the /resources/views/movies directory
    and contains a file create.blade.php (i haven't made it)
    */
  }

  public function store(Request $request) { //after creating a movie you have to make the revies
    $request->validate([ //to make a review ofcourse you need to fill some form, and alll of that form must be filled
      'title' => 'required',
      'description' => 'required',
      'release_date' => 'required|date',
    ]);

    Movie::create($request->all());

    return redirect()->route('movie.index'); 
  }

  public function show() {  //showing a movie
    return view('movies.show', compact('movie'));
  }

  public function edit() { // editing a movie
    return view('movies.edit', compact('movie')); 
  }

  public function update(Request $request, Movie $movies){
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'release_date' => 'required|date',
    ]);

    $movie->update($request->all());

    return redirect()->route('movies.index');
  }

  public function destroy(Movie $movie) {
    $movie->delete();
    return redirect()->route('movies.index');
  }
}
