<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DMController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IconController;



require __DIR__.'/auth.php';


// ルート（トップ）: ログイン有無で出し分け
Route::get('/', fn () => auth()->check()
    ? redirect()->route('home')
    : redirect()->route('login'));

// ③ /dashboard はホームへ寄せる（巨大ロゴ対策）
Route::get('/dashboard', fn () => redirect()->route('home'))
    ->middleware(['auth'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    // ホーム（ログイン必須）
    Route::view('/home', 'home')->name('home');

    // 旧リンク互換: /dashboard は /home へ
    Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // 新規投稿画面
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');        
    Route::get('/whoami', fn() => ['auth' => auth()->check(), 'id' => optional(auth()->user())->id]);

    Route::get('/board', [BoardController::class, 'index'])->name('board');

    Route::view('/mypage', 'layouts.mypage')->name('mypage');

    // 一覧
    Route::get('/dm', [DMController::class, 'index'])->name('dm.index');

    // 詳細（会話IDで開く）← dm.blade.php の route('dm.show', $c) と一致
    Route::get('/dm/{conversation}', [DMController::class, 'show'])->name('dm.show');

    // 送信（会話IDに紐づけて投稿）← route('dm.message.store', $active) と一致
    Route::post('/dm/{conversation}/messages', [DMController::class, 'store'])->name('dm.message.store');

    Route::get('/map', function () {
        return view('map'); 
    })->name('map');


    # 日本
    Route::get('/region/chugoku', function () {
        return view('regions/japan/chugoku'); 
    })->name('region.chugoku');

    Route::get('/region/hokkaido', function () {
        return view('regions/japan/hokkaido'); 
    })->name('region.hokkaido');

    Route::get('/region/hokuriku-tokai', function () {
        return view('regions/japan/hokuriku-tokai'); 
    })->name('region.hkuriku-tokai');

    Route::get('/region/kanto', function () {
        return view('regions/japan/kanto'); 
    })->name('region.kanto');

    Route::get('/region/kinki', function () {
        return view('regions/japan/kinki'); 
    })->name('region.kinki');

    Route::get('/region/kyushu', function () {
        return view('regions/japan/kyushu'); 
    })->name('region.kyushu');

    Route::get('/region/okinawa', function () {
        return view('regions/japan/okinawa'); 
    })->name('region.okinawa');

    Route::get('/region/shikoku', function () {
        return view('regions/japan/shikoku'); 
    })->name('region.shikoku');

    Route::get('/region/tohoku', function () {
        return view('regions/japan/tohoku'); 
    })->name('region.tohoku');



    # 海外
    Route::get('/region/africa', function () {
        return view('regions/africa'); 
    })->name('region.africa');

    Route::get('/region/asia', function () {
        return view('regions/asia'); 
    })->name('region.asia');

    Route::get('/region/europe', function () {
        return view('regions/europe'); 
    })->name('region.europe');

    Route::get('/region/japan', function () {
        return view('regions/japan'); 
    })->name('region.japan');

    Route::get('/region/latinamerica', function () {
        return view('regions/latinamerica'); 
    })->name('region.latinamerica');

    Route::get('/regions/map', function () {
        return view('regions/map'); 
    })->name('regions.map');

    Route::get('/region/middleeast', function () {
        return view('regions/middleeast'); 
    })->name('region.middleeast');

    Route::get('/region/northamerica', function () {
        return view('regions/northamerica'); 
    })->name('region.northamerica');

    Route::get('/region/oceania', function () {
        return view('regions/oceania'); 
    })->name('region.oceania');

    Route::get('/region/usa', function () {
        return view('regions/usa'); 
    })->name('region.usa');



//検索画面
Route::get('/search', [SearchController::class, 'index'])->name('search.index');



