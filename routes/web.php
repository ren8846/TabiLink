<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Auth\PasswordController; 


// ===== Views / Public pages =====
Route::get('/', function () {
    return view('home'); // 本当にhomeを出したい場合はこのまま。welcomeにしたいなら view('welcome')
})->name('root');

Route::get('/home', fn () => view('home'))->name('home');
Route::get('/board', fn () => view('board.index'))->name('board');
Route::get('/inquiry', fn () => view('inquiry'))->name('inquiry');
Route::get('/map', fn () => view('map'))->name('map');
Route::get('/region/{slug}', fn ($slug) => view('region', ['slug' => $slug]))->name('region');

// ===== Controllers =====
Route::get('/home', fn () => view('home'))->name('home');
Route::get('/board', fn () => view('board.index'))->name('board');
Route::get('/inquiry', fn () => view('inquiry'))->name('inquiry');
Route::get('/map', fn () => view('map'))->name('map');
Route::get('/region/{slug}', fn ($slug) => view('region', ['slug' => $slug]))->name('region');

// 検索
// 検索
Route::get('/search', [SearchController::class, 'index'])->name('search');

// 投稿
// 投稿
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store',  [PostController::class, 'store'])->name('post.store');
Route::post('/post/store',  [PostController::class, 'store'])->name('post.store');

// ===== Auth required area =====
Route::middleware('auth')->group(function () {
    Route::get('/mypage', fn () => view('mypage.index'))->name('mypage');
    Route::get('/mypage/profile/edit', fn () => view('mypage.profile.edit'))->name('mypage.profile.edit');


    // パスワード変更（Breezeのauth.phpを使う場合は、ここを消して重複回避）
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');
    // パスワード変更（Breezeのauth.phpを使う場合は、ここを消して重複回避）
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');

// 問い合わせページ
Route::get('/inquiry', function () {
    return view('inquiry'); // resources/views/inquiry.blade.php
})->name('inquiry');

// ===== Auth routes (Breeze / Jetstream / Fortify 等を導入済みなら必要) =====
require __DIR__ . '/auth.php';

// お問い合わせ送信処理用ルート
Route::post('/inquiry/send', 
[InquiryController::class, 'send'])->name('inquiry.send');

// 地図ページ
Route::get('/map', function () {
    return view('map'); // resources/views/map.blade.php を表示
})->name('map');

// 地域ページ（共通ビューへ遷移）
Route::get('/region/{slug}', function ($slug) {
    return view('region', ['slug' => $slug]);
})->name('region');
});