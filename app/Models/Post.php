<?php

namespace App\Models; 

use Illuminate\Support\Arr;

class Post
{
    private static $posts = [
        [
            'title' => 'Judul Postingan Pertama',
            'slug' => 'judul-postingan-pertama',
            'author' => 'Andi',
            'body' => 'Ini adalah isi dari postingan pertama...'
        ],
        [
            'title' => 'Judul Postingan Kedua',
            'slug' => 'judul-postingan-kedua',
            'author' => 'Budi',
            'body' => 'Ini adalah isi dari postingan kedua...'
        ],
    ];

    public static function all()
    {
        return self::$posts; 
    }

    public static function find($slug)
    {
        $post = Arr::first(static::all(), fn($post) => $post['slug'] == $slug);

        if (!$post) {
            abort(404);
        }

        return $post;
    }
}