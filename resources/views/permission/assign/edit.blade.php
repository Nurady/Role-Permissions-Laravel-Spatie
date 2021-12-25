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
            <form action="{{ route('assign.edit', $role) }}" method="post">
                @method('PUT')
                @csrf
                <div class="form-group mb-3">
                    <label for="role">
                        Role Name
                        <small class="text-muted text-sm">(Tidak bisa diubah)</small>
                    </label>
                    {{-- <select name="role" id="role" class="form-control">
                        <option disabled selected>Choose Role</option>
                        @foreach ($roles as $item)
                            <option Readonly value="{{ $item->id }}" {{ $role->id == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select> --}}
                    @if ($role->id == $role->id )
                        <input Readonly type="text" name="role" id="role" value="{{ $role->name  }}" class="form-control">                                
                    @endif
                    @error('role')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="permissions">Permissions</label>
                    <select name="permissions[]" id="permissions" class="form-control select2" multiple>
                        @foreach ($permissions as $permission)
                            <option value="{{ $permission->id }}" {{ $role->permissions()->find($permission->id) ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('permissions')
                        <div class="text-danger mt-2 d-block">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection