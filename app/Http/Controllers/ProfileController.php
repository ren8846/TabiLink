<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        $user = $request->user();

        // プロフィール（無ければ空で）
        $profile = $user->profile ?: new Profile([
            'users_id' => $user->id,
            'gender'   => 'U', // 未回答
        ]);

        // 自分の投稿履歴
        $posts = $user->posts()->latest()->paginate(12);

        return view('mypage.profile.edit', compact('user','profile','posts'));
    }
    public function update(\Illuminate\Http\Request $request)
{
    // ログインユーザーを取得
    $user = auth()->user();

    // 該当ユーザーのプロフィールを取得（無ければ新規作成）
    $profile = \App\Models\Profile::firstOrNew(['users_id' => $user->id]);

    // フォームの値を反映
    $profile->fill([
        'name' => $request->input('name'),
        'gender' => $request->input('gender'),
        'self_introduction' => $request->input('self_introduction'),
    ]);

    // 保存
    $profile->save();

    // 編集画面へリダイレクト
    return redirect()->route('mypage.profile.edit')->with('status', 'プロフィールを更新しました');
}

}