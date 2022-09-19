<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Posts
{

    public static function all(): array
    {
        $posts = File::files(resource_path("postData/"));
        return array_map(function($post){
            return $post->getContents();
        }, $posts);
    }

    public static function find($slug)
    {
        $path = resource_path("postData/{$slug}.html");

        if(!file_exists($path)){
            throw new ModelNotFoundException();
        }

        return cache()->remember("post.{$slug}", 5, fn() => file_get_contents($path));
    }
}
