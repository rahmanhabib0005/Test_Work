<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function() {
     Route::get('/login',[AuthController::class, 'index'])->name('login');
     Route::post('/login',[AuthController::class, 'login'])->name('login')->middleware('throttle:2,1');
     Route::get('/register-view',[AuthController::class, 'register_view'])->name('register');
     Route::post('/register',[AuthController::class, 'register'])->name('register')->middleware('throttle:2,1');
});

Route::group(['middleware' => 'auth'], function() {
     Route::get('/logout',[AuthController::class, 'logout'])->name('logout');
     Route::get('/post',[AuthController::class, 'getPost']);
     Route::get('/',[AuthController::class,'home']);
     Route::post('/',[PostController::class,'post'])->name('home');
     Route::post('/comment',[CommentController::class,'postComment'])->name('comment');
});

