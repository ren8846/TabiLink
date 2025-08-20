<?php

namespace App\Http\Controllers;

class MypageController extends Controller
{
    public function index()
    {
        return to_route('mypage');    // メニューを出すだけ
    }
}
