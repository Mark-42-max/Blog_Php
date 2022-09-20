
{{--    @foreach ($posts as $post)--}}
{{--    <article class="post">--}}
{{--        <h1 class="post-title"><a href="/posts/{{$post->slug}}">{{$post->title}}</a></h1>--}}

{{--        <p>By <a href="/authors/{{ $post->author->username }}">{{ $post->author->name }}</a> from <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>--}}

{{--        {{$post->excerpt }}--}}
{{--    </article>--}}
{{--    @endforeach--}}

<x-layout >

    <x-_posts-header :categories="$categories"/>

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">

        @if ($posts->count())
        <x-post-card-special :post="$posts[0]"/>

        <div class="lg:grid lg:grid-cols-2">

            @foreach ($posts->skip(1) as $post)
                <x-post-card :post="$post"/>
            @endforeach
        </div>

        @else
            <p class="text-center">No posts yet. Please check back later.</p>
        @endif

{{--        <div class="lg:grid lg:grid-cols-3">--}}
{{--            <x-post-card />--}}

{{--            <x-post-card />--}}

{{--            <x-post-card />--}}
{{--        </div>--}}
    </main>

</x-layout>

