<?php

namespace App\Http\Controllers;

use Auth, View;
use DB;
use PDF;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /*user authentication*/
    public function __construct()
    {
    $this->middleware('auth');
    }
    /*get all user from the Model*/
    public function index()
    {   
        $posts = Post::with('user')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }
    /*return view create post*/
    public function create()
    {
        return view('admin.posts.create');
    }

    /*send data to a controller method with a POST request*/
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
    /*show post*/
    public function show($id)
    {

    }
    /*edit post*/
    public function edit($id)
    {
        $posts = Post::find($id);
        return view('admin.posts.edit',compact('posts'));
    }
    /*send data updated*/
    public function update(PostRequest $request, $id)
    {
        $posts = Post::findOrFail($id);
        $posts->Update($request->all());
        return redirect()->route('posts.index')->with('success', 'Post updated success!');
    }
    /*delete post*/
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
            $post['message'] = "Post Successfully Deleted!";
        } else {
            $post['result'] = false;
            $post['message'] = "Post was not Deleted, Try Again!";
        }
        return redirect()->route('posts.index')->with('success', 'Post deleted success');
    }
    /*Generate PDF*/
    public function createPDF() 
    {
        /*retreive all records from db*/
        $posts = Post::with('user')->get();
        /*share data to view*/
        view()->share('posts',$posts);
        $pdf = PDF::loadView('admin.posts.pdf_view', compact('posts'))
        ->setPaper('a4','landscape');
        /*share data to view*/
        return $pdf->download('pdf_file.pdf');
    }
}
