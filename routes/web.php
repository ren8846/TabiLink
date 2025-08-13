<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\PostController;

Route::get('/home', function () { return view('home'); })->name('home');
Route::get('/search', function () { return '検索ページ'; })->name('search');
Route::get('/post/create', function () { return '投稿作成ページ'; })->name('post.create');
Route::get('/board', function () { return '掲示板ページ'; })->name('board');
Route::get('/mypage', function () { return view('mypage'); })->name('mypage');



Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

// マイページ
Route::get('/mypage', function () {
    return view('mypage');
})->name('mypage');

// プロフィールページ
Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

// パスワードページ
Route::get('/password/change', function () {
    return view('password.change');
})->name('password.change');

// 問い合わせページ
Route::get('/inquiry', function () {
    return view('inquiry'); // resources/views/inquiry.blade.php
})->name('inquiry');
