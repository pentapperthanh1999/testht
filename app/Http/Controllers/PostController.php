<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::with('user')->get();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }


    public function store(PostRequest $request)
    {
        Auth::user();
        $userPost = new Post;
        $userPost->title = $request->title;
        $userPost->desc = $request->desc;
        $userPost->user_id = Auth::user()->id;
        $userPost->save();
        return redirect()->route('posts.index')->with('success', 'Post created success!');
    }

    
    public function show($id)
    {

    }

    
    public function edit($id)
    {
        $posts = Post::find($id);
        return view('admin.posts.edit',compact('posts'));
    }

    public function update(PostRequest $request, $id)
    {
        $posts = Post::findOrFail($id);
        $posts->Update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated success!');
    }

    public function destroy($id)
    {
        try{
            $post = Post::findOrFail($id);
        } catch( Exception $e){
            dd($e);
            $error = 'No Post to delete!' . $e->getCode();
            return Response::json(['error' => $error]);
        }
        $result = $post->delete();
        if ($result) {
            $post['result'] = true;
            $post['message'] = "post Successfully Deleted!";
        } else {
            $post['result'] = false;
            $post['message'] = "post was not Deleted, Try Again!";
        }
        return redirect()->route('posts.index')->with('success', 'Post deleted success');
    }
}
