<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ProfileController extends Controller
{
    public function edit()
    {
        $user  = auth()->user();
        $posts = Post::where('users_id', $user->id)->latest()->take(12)->get(); // サムネ用
        return view('profile.edit', compact('user','posts'));
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'     => ['nullable','string','max:255'],
            'username' => ['nullable','string','max:255','unique:users,username,'.$user->id],
            'gender'   => ['nullable','in:male,female'],
            'bio'      => ['nullable','string','max:1000'],
        ]);

        $user->update($data);
        return back()->with('status', 'プロフィールを更新しました');
    }
}
