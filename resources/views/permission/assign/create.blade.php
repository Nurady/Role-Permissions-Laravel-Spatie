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
        <div class="card-header">Give Permission</div>
        <div class="card-body">
            <form action="{{ route('assign.create') }}" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="role">Role Name</label>
                    <select name="role" id="role" class="form-control">
                        <option disabled selected>Choose Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="permissions">Permissions</label>
                    <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                        @endforeach
                    </select>
                    @error('permissions')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-secondary">Assign</button>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Table of Role And Permission</div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Role</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
                @foreach ($roles as $key=>$role)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ implode(', ', $role->getPermissionNames()->toArray()) }}</td>
                        <td>
                            <a href="{{ route('assign.edit', $role) }}" class="btn btn-primary btn-sm">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection