<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('post.index', [
            'posts' => Post::get()
        ]);
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . Str::random(6),
            'description' => $request->description,
        ]);

        return redirect()->route('posts.index');
    }

    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('posts.index');
    }

    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
