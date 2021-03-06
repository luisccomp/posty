<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;

/*
|--------------------------------------------------------------------------|
| Web Routes                                                               |
|--------------------------------------------------------------------------|
|                                                                          |
| Here is where you can register web routes for your application. These    |
| routes are loaded by the RouteServiceProvider within a group which       |
| contains the "web" middleware group. Now create something great!         |
|                                                                          |
|--------------------------------------------------------------------------|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

// HomeController Routes
Route::get('/', [HomeController::class, 'index'])
    ->name('home');

// PostController Routes
// Route::get('/posts', function() {
//     return view('posts.index');
// });
Route::get('/posts', [PostController::class, 'index'])
    ->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])
    ->name('posts.show');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy');

// RegisterController routes
Route::get('/register', [RegisterController::class, 'index'])
    ->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// DashboardController routes
// Quando utilizado dessa forma, o Middleware só será ativado quando uma requisição for chamada utilizando esta rota
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// LoginController routes
Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'store']);

// LogoutController routes
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// PostLikeController routes
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])
    ->name('posts.likes');
Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])
    ->name('posts.like');

// UserPostController Routes
Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])
    ->name('user.posts');
