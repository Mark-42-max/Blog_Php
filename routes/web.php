<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Models\Category;
use App\Models\User;
use App\Services\Newsletter;
use Illuminate\Support\Facades\Route;
use \App\Models\Post;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;
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

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/posts/{post}', [PostController::class, 'show']);

Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');
Route::get('register/oauth', [RegisterController::class, 'redirectToSms'])->middleware('guest');
Route::post('register/oauth/verify', [RegisterController::class, 'checkAndRedirect'])->middleware('guest');

Route::get('register/google', [RegisterController::class, 'redirectToGoogle'])->middleware('guest');
Route::get('register/facebook', [RegisterController::class, 'redirectToFacebook'])->middleware('guest');

Route::post('logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::post('session', [SessionController::class, 'store'])->middleware('guest');
Route::get('login', [SessionController::class, 'create'])->middleware('guest');

Route::post('newsletter', NewsletterController::class);

//Google Login
Route::get('login/google', [SessionController::class, 'redirectToGoogle'])->name('login.google')->middleware('guest');
Route::get('login/google/callback', [SessionController::class, 'handleGoogleCallback'])->middleware('guest');

//Facebook Login
Route::get('login/facebook', [SessionController::class, 'redirectToFacebook'])->name('login.facebook')->middleware('guest');
Route::get('login/facebook/callback', [SessionController::class, 'handleFacebookCallback'])->middleware('guest');

//Message route
Route::post('message', [MessageController::class, 'create'])->middleware('auth');

//Admin Route
Route::get('admin/posts/create', [PostController::class, 'create'])->middleware('admin');
Route::post('admin/posts/make', [PostController::class, 'make'])->middleware('admin');


//->where('post', '[A-z_\-]+');
