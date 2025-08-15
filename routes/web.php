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


// 地域ページ共通
Route::get('/region/{name}', function ($name) {

    $regions = [
        'japan' => [
            'title' => '日本',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/9/9e/Mount_Fuji_from_Hakone_2.jpg',
            'description' => 'ここは日本のページです。観光情報や文化、地理などを紹介できます。',
        ],
        'asia' => [
            'title' => 'アジア',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/69/Asia_satellite.jpg',
            'description' => 'アジア地域の紹介ページです。',
        ],
        'europe' => [
            'title' => '欧州',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/8/83/Europe_satellite.jpg',
            'description' => '欧州地域の紹介ページです。',
        ],
        'northAmerica' => [
            'title' => '北米',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5b/North_America_satellite.jpg',
            'description' => '北米地域の紹介ページです。',
        ],
        'latinAmerica' => [
            'title' => '中南米',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/0/0b/Latin_America_satellite.jpg',
            'description' => '中南米地域の紹介ページです。',
        ],
        'usa' => [
            'title' => 'アメリカ',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/3/3e/USA_satellite.jpg',
            'description' => 'アメリカの紹介ページです。',
        ],
        'middleEast' => [
            'title' => '中東',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/2/2b/Middle_East_satellite.jpg',
            'description' => '中東地域の紹介ページです。',
        ],
        'africa' => [
            'title' => 'アフリカ',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/63/Africa_satellite.jpg',
            'description' => 'アフリカ地域の紹介ページです。',
        ],
        'oceania' => [
            'title' => '大洋州',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/3/3d/Oceania_satellite.jpg',
            'description' => '大洋州地域の紹介ページです。',
        ],
    ];

    if (!isset($regions[$name])) abort(404);

    return view('regions.region', ['region' => $regions[$name]]);
});