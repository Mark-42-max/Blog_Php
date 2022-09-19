<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Posts
{

    public $title;

    public $excerpt;

    public $date;

    public $body;

    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function() {
            return collect(File::files(resource_path("postData/")))->map(function($post){
                return YamlFrontMatter::parseFile($post);
            })->map(function($document){
                return new Posts(
                    $document->title,
                    $document->excerpt,
                    $document->date,
                    $document->body(),
                    $document->slug,
                );
            })->sortBy('date');
        });
    }

    public static function find($slug)
    {
        $post = static::all()->firstWhere('slug', $slug);

        if(!$post){
            throw new ModelNotFoundException();
        }

        return $post;
    }
}
