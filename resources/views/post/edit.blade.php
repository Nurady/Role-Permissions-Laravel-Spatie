@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Edit Post</div>
        <div class="card-body">
            <form action="{{ route('posts.edit', $post) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') ?? $post->title }}">
                    @error('title')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="description">Description</label>
                    <input type="text" name="description" id="description" class="form-control" value="{{ old('description') ?? $post->description }}">
                    @error('title')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection