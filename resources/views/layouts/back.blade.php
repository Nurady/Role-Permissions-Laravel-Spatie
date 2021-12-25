@extends('layouts.base')

@section('body')
    <div class="container-fluid">
        <div class="py-3">
            <div class="row">
                <div class="col-md-3">
                    <x-Layouts.sidebar></x-Layouts.sidebar>    
                </div>
                <div class="col-md-9">
                    <div class="d-flex justify-content-end">
                        Hi, <span>
                            <strong>
                                <span class="text-uppercase px-1">
                                    {{ auth()->user()->name }} 
                                </span>
                                <span class="text-capitalize">
                                    ({{ implode(', ', auth()->user()->getRoleNames()->toArray()) }})
                                </span>
                            </strong>
                        </span> 
                    </div>
                    <div class="mt-2">
                        @yield('content') 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection