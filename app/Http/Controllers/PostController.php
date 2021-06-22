<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('guests.posts.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();

        if(!$post) {
            abort('404');
        }

        $data = [
            'post' => $post,
            'post_category' => $post->category
        ];

        return view('guests.posts.show', $data);
    }
}
