<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\InquiryController;
// 認証Breeze系のパスワード更新コントローラを使うならこちら
use App\Http\Controllers\Auth\PasswordController; // ←自作のPasswordControllerがあるならこの行はあなたの名前空間に合わせて変更

// 検索
Route::get('/search', [SearchController::class, 'index'])->name('search');

// 投稿
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::post('/post/store',  [PostController::class, 'store'])->name('post.store');

// ===== Auth required area =====
Route::middleware('auth')->group(function () {
    Route::get('/mypage', fn () => view('mypage.index'))->name('mypage');
    Route::get('/mypage/profile/edit', fn () => view('mypage.profile.edit'))->name('mypage.profile.edit');

    // パスワード変更（Breezeのauth.phpを使う場合は、ここを消して重複回避）
    Route::post('/password/update', [PasswordController::class, 'update'])->name('password.update');

    // お問い合わせ送信
    Route::post('/inquiry/send', [InquiryController::class, 'send'])->name('inquiry.send');
});

// ===== Auth routes (Breeze / Jetstream / Fortify 等を導入済みなら必要) =====
require __DIR__ . '/auth.php';
