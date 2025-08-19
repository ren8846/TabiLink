<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'subject' => ['required','string','max:255'],
            'message' => ['required','string','max:2000'],
        ]);

        Inquiry::create([
            'user_id' => $request->user()->id,
            'subject' => $data['subject'],
            'body'    => $data['message'],
        ]);

        return redirect()->route('mypage.index')->with('status','お問い合わせを送信しました');
    }
}
