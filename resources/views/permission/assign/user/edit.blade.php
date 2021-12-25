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
        <div class="card-header">Sync Role to <strong class="text-uppercase">{{ $user->name }}</strong> </div>
        <div class="card-body">
            <form action="{{ route('assign.user.edit', $user) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group mb-3">
                    <label for="user">User</label>
                    <input readonly type="text" name="user" id="user" class="form-control" value="{{ $user->email }}">
                </div>
                <div class="form-group mb-3">
                    <label for="roles">Roles</label>
                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->roles()->find($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
               
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection