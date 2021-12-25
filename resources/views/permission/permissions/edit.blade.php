@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Edit Permission</div>
        <div class="card-body">
            <form action="{{ route('permissions.edit', $permission) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $permission->name }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection