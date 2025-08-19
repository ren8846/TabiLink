<?php

namespace App\Http\Controllers;

class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.index'); // メニューを出すだけ
    }
}
