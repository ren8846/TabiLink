<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// ① 常にホームを見る
Route::get('/home', fn () => view('home'))->name('home');

// ② ルート / はホームへ寄せる（welcome を使わない）
Route::get('/', fn () => redirect()->route('home'));

// ③ /dashboard はホームへ寄せる（巨大ロゴ対策）
Route::get('/dashboard', fn () => redirect()->route('home'))
     ->middleware(['auth'])
     ->name('dashboard');

// ④ 認証エリア
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // 新規投稿画面
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');        
Route::get('/whoami', fn() => ['auth' => auth()->check(), 'id' => optional(auth()->user())->id]);
// 画面遷移用のスタブ
Route::get('/map', fn () => view('map'))->name('map');
Route::get('/dm',  fn () => view('dm'))->name('dm');

Route::get('/board', [BoardController::class, 'index'])->name('board');


require __DIR__.'/auth.php';


# 日本

use App\Http\Controllers\JapanController;

Route::get('/region/kanto', [JapanController::class, 'showKanto'])->name('region.kanto');
Route::get('/region/kinki', [JapanController::class, 'showkinki'])->name('region.kinki');
Route::get('/region/tohoku', [JapanController::class, 'showtohoku'])->name('region.tohoku');
Route::get('/region/chugoku', [JapanController::class, 'showchugoku'])->name('region.chugoku');
Route::get('/region/shikoku', [JapanController::class, 'showshikoku'])->name('region.shikoku');
Route::get('/region/kyushu', [JapanController::class, 'showkyushu'])->name('region.kyushu');
Route::get('/region/okinawa', [JapanController::class, 'showokinawa'])->name('region.okinawa');
Route::get('/region/hokkaido', [JapanController::class, 'showhokkaido'])->name('region.hokkaido');
Route::get('/region/hokuriku-tokai', [JapanController::class, 'showhokurikutokai'])->name('region.hokuriku-tokai');


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

Route::get('/map', function () {
    return view('map'); // resources/views/map.blade.php を表示
})->name('map');
