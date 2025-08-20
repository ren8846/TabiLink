<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function edit()
    {
        return view('mypage.notifications.edit'); // ← このBladeを作る
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->notify_enabled = $request->boolean('notify_enabled');
        $user->save();

        return redirect()->route('mypage.notifications.edit')->with('status', '通知設定を更新しました');
    }

}
