@extends('admin.posts.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Post</h2>
                <p>Hi! {{auth()->user()->name}}</p>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('posts.create') }}"> Create New post</a>

            </div>
        </div>
        
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>STT</th>
            <th>Title</th>
            <th>Desc</th>
            <th>User</th>
            <th width="280px">Action</th>
        </tr>
        @php($i = 0)
        @foreach ($posts as $post)
        <tr>
            <td><?php echo ++$i; ?></td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->desc }}</td>
            <th>{{ $post->user->name }}</th>
            <td>
                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
   
                    <a class="btn btn-info" href="#">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('posts.edit',$post->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      
@endsection