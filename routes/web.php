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

// 地図ページ
Route::get('/map', function () {
    return view('regions.map'); // resources/views/map.blade.php を表示
})->name('map');

// 日本ページ
Route::get('/japan', function () {
    return view('regions.japan'); // resources/views/regions/japan.blade.php を作る
})->name('japan');

// アジアページ
Route::get('/asia', function () {
    return view('regions.asia'); // resources/views/regions/asia.blade.php を作る
})->name('asia');

// 欧州
Route::get('/europe', function () {
    return view('regions.europe'); // resources/views/regions/europe.blade.php
})->name('europe');

// 北米
Route::get('/north-america', function () {
    return view('regions.northAmerica'); // resources/views/regions/northAmerica.blade.php
})->name('north-america');

// 中南米
Route::get('/latin-america', function () {
    return view('regions.latinAmerica'); // resources/views/regions/latinAmerica.blade.php
})->name('latin-america');

// アメリカ
Route::get('/usa', function () {
    return view('regions.usa'); // resources/views/regions/usa.blade.php
})->name('usa');

// 中東
Route::get('/middle-east', function () {
    return view('regions.middleEast'); // resources/views/regions/middleEast.blade.php
})->name('middle-east');

// アフリカ
Route::get('/africa', function () {
    return view('regions.africa'); // resources/views/regions/africa.blade.php
})->name('africa');

// 大洋州
Route::get('/oceania', function () {
    return view('regions.oceania'); // resources/views/regions/oceania.blade.php
})->name('oceania');


// 都道府県ページ（例：北海道）
Route::get('/region/hokkaido', function() {
    return view('regions.hokkaido'); // resources/views/regions/hokkaido.blade.php を作成
})->name('region.hokkaido');

Route::get('/region/tohoku', function() {
    return view('regions.tohoku');
})->name('region.tohoku');

Route::get('/region/kanto', function() {
    return view('regions.kanto');
})->name('region.kanto');

Route::get('/region/hokuriku-tokai', function() {
    return view('regions.hokuriku-tokai');
})->name('region.hokuriku-tokai');

Route::get('/region/kinki', function() {
    return view('regions.kinki');
})->name('region.kinki');

Route::get('/region/chugoku', function() {
    return view('regions.chugoku');
})->name('region.chugoku');

Route::get('/region/shikoku', function() {
    return view('regions.shikoku');
})->name('region.shikoku');

Route::get('/region/kyushu', function() {
    return view('regions.kyushu');
})->name('region.kyushu');

Route::get('/region/okinawa', function() {
    return view('regions.okinawa');
})->name('region.okinawa');