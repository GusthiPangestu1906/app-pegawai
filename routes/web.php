<?php

use App\Models\Post; 
use Illuminate\Support\Facades\Route;

Route::get('/posts', function () {
    return view('posts', [
        'title' => 'Blog',
        'posts' => Post::all()
    ]);
});

Route::get('/posts/{slug}', function ($slug) {
    return view('post', [
        'title' => 'Single Post',
        'post' => Post::find($slug)
    ]);
});