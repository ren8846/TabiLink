<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('notifications.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = $request->user();
        $user->notify_enabled = $request->boolean('notify_enabled');
        $user->save();

        return back()->with('status', '通知設定を更新しました');
    }
}
