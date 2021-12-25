@extends('layouts.back')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />    
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select Permissions"
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
          $('.alert').alert()
        })
      </script>
@endpush

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span type="button" class="close mr-3" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
            <strong>{{ session('success') }}</strong>
        </div>
    @endif
   
    <div class="card mb-5">
        <div class="card-header">Pick Roles and Permission to User</div>
        <div class="card-body">
            <form action="{{ route('assign.user.create') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="user">User</label>
                    <input type="text" name="user" id="user" class="form-control">
                    {{-- <select name="users[]" id="users" class="form-control select2" multiple>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->email }}</option>
                        @endforeach
                    </select> --}}
                </div>
                <div class="form-group mb-3">
                    <label for="roles">Roles</label>
                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
               
                <button type="submit" class="btn btn-secondary">Assign</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Table of User Role</div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            {{ implode(', ', $user->getRoleNames()->toArray()) }} 
                        </td>
                        <td>
                            <a href="{{ route('assign.user.edit', $user) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection