<?php

use Illuminate\Support\Facades\Route;
use \App\Models\Posts;

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
        'posts' => Posts::all()
    ]);
});

Route::get('/posts/{post}', function ($slug) {
    $post = Posts::find($slug);
    return view('post', ['post' => $post]);

})->where('post' , '[A-z0-9_\-]+' );


