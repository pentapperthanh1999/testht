<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <td>STT</td>
        <td>Title</td>
        <td>Desc</td>
        <td>User</td>
      </tr>
      </thead>
      <tbody>
        @php($i = 0)
        @foreach ($posts as $post)
        <tr>
            <td><?php echo ++$i; ?></td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->desc }}</td>
            <td>{{ $post->user->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>