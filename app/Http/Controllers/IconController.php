<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IconController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('icon.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'icon' => ['required','image','max:2048'], // 2MB
        ]);

        $path = $request->file('icon')->store('avatars', 'public');

        $user = $request->user();
        $user->avatar_url = '/storage/'.$path; // 表示用URL
        $user->save();

        return redirect()->route('mypage.profile.edit')->with('status','アイコンを更新しました');
    }
}
