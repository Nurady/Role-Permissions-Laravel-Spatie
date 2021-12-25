@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Edit Role</div>
        <div class="card-body">
            <form action="{{ route('roles.edit', $role) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') ?? $role->name }}">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection