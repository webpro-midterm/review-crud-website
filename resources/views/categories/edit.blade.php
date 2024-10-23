@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control">
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
