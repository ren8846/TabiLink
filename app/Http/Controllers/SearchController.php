<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
     public function index()
    {
        // 検索ページのビューを返す
        return view('search');
    }
}

