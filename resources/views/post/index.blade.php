@extends('layouts.back')

@section('content')
    <div class="card mb-4">
        <div class="card-header">All Posts</div>
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
                @foreach ($posts as $index=>$post)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ $post->created_at->format("d F Y") }}</td>
                        <td>
                            @can('edit post')
                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                            @else
                                Forbidden
                            @endcan
                            @can('delete post')                                
                                <a href="{{ route('posts.delete', $post) }}" class="btn btn-danger btn-sm">delete</a>                                
                            @else
                               Forbidden
                            @endcan
                        </td>
                            

                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection