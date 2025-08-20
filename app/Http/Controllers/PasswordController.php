<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        // resources/views/mypage/password/edit.blade.php を返す
        return view('mypage.password.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => ['required','current_password'],
            'password'         => ['required','string','min:8','confirmed'], // password + password_confirmation
        ]);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('mypage.password.edit')->with('status', 'パスワードを更新しました');
    }
}
