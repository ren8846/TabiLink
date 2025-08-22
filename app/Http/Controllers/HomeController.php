<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        // ユーザーとプロフィールをまとめて取得（N+1回避）
        $posts = Post::with(['user.profile'])
            ->latest('created_at')
            ->paginate(10);

        return view('home', compact('posts')); // ← ここで渡す
    }
}
