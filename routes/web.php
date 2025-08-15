<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // まずはLaravel既定のwelcomeを出す
});

Route::get('/', function () {
    return view('home');
});

use App\Http\Controllers\PostController;

Route::get('/home', function () { return view('home'); })->name('home');
Route::get('/search', function () { return '検索ページ'; })->name('search');
Route::get('/post/create', function () { return '投稿作成ページ'; })->name('post.create');

use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])->name('search');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

// 掲示板ページ
Route::get('/board', function () {
    return view('board.index');
})->name('board');

// マイページ
Route::get('/mypage', function () {
    return view('mypage.index');
})->name('mypage');

// プロフィールページ
Route::get('/mypage/profile/edit', function () {
    return view('mypage.profile.edit');
})->name('mypage.profile.edit');

// パスワードページ
Route::get('/password/change', function () {
    return view('password.change');
})->name('password.change');

// パスワード更新処理
Route::post('/password/update', 
[PasswordController::class, 'update'])->name('password.update');

// 問い合わせページ
Route::get('/inquiry', function () {
    return view('inquiry'); // resources/views/inquiry.blade.php
})->name('inquiry');

// お問い合わせ送信処理用ルート
Route::post('/inquiry/send', 
[InquiryController::class, 'send'])->name('inquiry.send');
