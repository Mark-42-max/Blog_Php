<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Blog Site</title>
</head>
<body>
    @foreach ($posts as $post)
    <article class="post">
        <h1 class="post-title"><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h1>

        <p><a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>

        {{$post->excerpt }}
    </article>
    @endforeach

</body>
</html>
