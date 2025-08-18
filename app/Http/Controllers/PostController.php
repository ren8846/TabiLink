<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // 全件取得
        $posts = Post::all();
        return response()->json($posts);
    }

      // 投稿作成ページを表示
    public function create()
    {
        return view('posts.create'); // resources/views/post/create.blade.php を表示
    }

    public function store(Request $request)
    {
        // 新規作成
        $data = $request->validate([
        'post_content' => ['required','string'],
        'post_tag' => ['nullable','string','max:255'], 
        ]);
        $post = Post::create($data);
        return redirect()->route('posts.create')->with('status', '投稿しました！');

    }

    public function show($id)
    {
        // 1件取得
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        // 更新
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        // 削除
        Post::destroy($id);
        return response()->json(null, 204);
    }
}
