<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BoardController;
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

// 画面遷移用のスタブ
Route::get('/map', fn () => view('map'))->name('map');
Route::get('/dm',  fn () => view('dm'))->name('dm');

Route::get('/board', [BoardController::class, 'index'])->name('board');

require __DIR__.'/auth.php';
