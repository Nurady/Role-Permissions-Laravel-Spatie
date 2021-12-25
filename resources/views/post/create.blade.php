@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Create New Post</div>
        <div class="card-body">
            <form action="{{ route('posts.create') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    @error('title')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control">
                    @error('title')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create</button>
            </form>
        </div>
    </div>
@endsection