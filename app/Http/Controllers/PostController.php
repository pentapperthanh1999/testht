<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            /*'user_id' => 'required',*/
        ]);

        Post::create($request->all());
        return redirect()->route('posts.index')->with('success', 'Post created success!');
    }

    
    public function show($id)
    {
        return view('admin.posts.index');
    }

    
    public function edit(Post $post)
    {
        return view('admin.posts.edit',compact('post'));
    }

    public function update(Request $request, Post $posts)
    {
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'user_id' => 'required',
        ]);
        Post::create($request->all());
        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted success');
    }
}
