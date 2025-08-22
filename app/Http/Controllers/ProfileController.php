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
    public function update(Request $request)
{
    $user = auth()->user();

    // ★ バリデーション：画像は任意、2MBまで
    $validated = $request->validate([
    'name' => ['nullable','string','max:255'],
    'gender' => ['nullable','in:M,F,U'],
    'self_introduction' => ['nullable','string','max:2000'],
    // ここを修正
    'icon' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
]);

    // ★ プロフィール取得（なければ新規）
    $profile = \App\Models\Profile::firstOrNew(['users_id' => $user->id]);

    // テキスト系を反映
    $profile->fill([
        'name' => $validated['name'] ?? $profile->name,
        'gender' => $validated['gender'] ?? $profile->gender,
        'self_introduction' => $validated['self_introduction'] ?? $profile->self_introduction,
    ]);

    // ★ 画像アップロードがあれば保存
    if ($request->hasFile('icon')) {
        // 以前のファイルがあれば削除
        if (!empty($profile->icon_path) && \Storage::disk('public')->exists($profile->icon_path)) {
            \Storage::disk('public')->delete($profile->icon_path);
        }

        // publicディスクの icons/ に保存（例：icons/xxxxxx.jpg）
        $path = $request->file('icon')->store('icons', 'public');
        $profile->icon_path = $path;
    }

    $profile->save();

    return redirect()->route('mypage.profile.edit')->with('status', 'プロフィールを更新しました');
}


}