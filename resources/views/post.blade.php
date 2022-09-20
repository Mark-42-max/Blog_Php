<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Document</title>
</head>
<body>
        <article class="post">
            <h1 class="post-title"> {{ $post->title }} </h1>

            <p>By <a href="#">{{$post->author->name}}</a> from <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>

            {!! $post->body !!}
        </article>

    <a href="/">Go back</a>

</body>
</html>
