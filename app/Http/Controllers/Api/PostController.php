<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        $posts_for_response = [];
        foreach($posts as $post) {
            $posts_for_response[] = [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'category' => $post->category ? $post->category->name : ''
            ];
        }

        $result = [
            'posts' => $posts_for_response,
            'success' => true
        ];

        return response()->json($result);
    }
}
