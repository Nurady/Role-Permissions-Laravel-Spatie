@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">Create New Permission</div>
        <div class="card-body">
            <form action="{{ route('permissions.create') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Create</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">Table of Permissions</div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                @foreach ($permissions as $index=>$permission)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->created_at->format("d F Y") }}</td>
                        <td>
                            <a href="{{ route('permissions.edit', $permission) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection