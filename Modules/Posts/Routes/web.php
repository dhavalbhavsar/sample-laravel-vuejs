<?php

use Modules\Posts\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes For Posts
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/posts', [PostsController::class, 'index'])->middleware(['auth', 'verified'])->name('posts');
Route::post('/post/create', [PostsController::class, 'store'])->middleware(['auth', 'verified'])->name('posts.create');
Route::put('/post/update/{id}', [PostsController::class, 'update'])->middleware(['auth', 'verified'])->name('posts.update');
Route::delete('/post/destroy/{id}', [PostsController::class, 'destroy'])->middleware(['auth', 'verified']);