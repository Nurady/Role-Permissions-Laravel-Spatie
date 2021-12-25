@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">USER DOES NOT HAVE THE RIGHT PERMISSIONS</div>

                <div class="card-body">
                   <a href="{{ route('dashboard') }}">Dashboard</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection