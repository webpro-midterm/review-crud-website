@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Category</h1>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
