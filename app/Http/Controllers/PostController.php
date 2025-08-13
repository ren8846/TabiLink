<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    // 投稿作成ページを表示
    public function create()
    {
        return view('post.create'); // resources/views/post/create.blade.php を表示
    }
}