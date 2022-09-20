<?php

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use \App\Models\Post;
use \Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('posts', [
        'posts' => Post::latest()->get(),
        'categories' => Category::all(),
    ]);
});

Route::get('/posts/{post}', function (Post $post) {
    //$post = Post::findOrFail($id);
    return view('post', ['post' => $post]);

});

Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', [
        'posts' => $category->posts,
        'categories' => Category::all(),
    ]);
});

Route::get('/authors/{author:username}', function (User $author) {

    return view('posts', [
        'posts' => $author->posts,
        'categories' => Category::all(),
    ]);
});

//->where('post', '[A-z_\-]+');


