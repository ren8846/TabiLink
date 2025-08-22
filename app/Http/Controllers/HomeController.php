<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = \App\Models\Post::with('images')  // ← これを追加
        ->latest('post_id')
        ->paginate(10);

        return view('home', compact('posts'));
    }
}

