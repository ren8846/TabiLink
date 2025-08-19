<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IconController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



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

Route::get('/map', function () {
    return view('map'); // resources/views/map.blade.php を表示
})->name('map');

//検索画面
Route::get('/search', [SearchController::class, 'index'])->name('search.index');

//マイページ
Route::middleware('auth')->prefix('mypage')->name('mypage.')->group(function () {
    Route::get('/', [MypageController::class, 'index'])->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::patch('/password', [PasswordController::class, 'update'])->name('password.update');

    Route::get('/notifications', [NotificationController::class, 'edit'])->name('notifications.edit');
    Route::patch('/notifications', [NotificationController::class, 'update'])->name('notifications.update');

    // Route::get('/inquiry',  [ContactController::class, 'create'])->name('inquiry.create');
    // Route::post('/inquiry', [ContactController::class, 'store'])->name('inquiry.send');

    Route::get('/icon', [IconController::class, 'edit'])->name('icon.edit');
    Route::post('/icon', [IconController::class, 'update'])->name('icon.update');
});

//お問い合わせ
Route::middleware('auth')->group(function () {
    Route::get('/mypage/inquiry',  [ContactController::class, 'create'])->name('inquiry.create');
    Route::post('/mypage/inquiry', [ContactController::class, 'store'])->name('inquiry.send');
});

//ログアウト
Route::middleware('auth')->get('/logout/confirm', function () {
    return view('auth.logout-confirm'); // ← ②で作るBlade
})->name('logout.confirm');

Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home'); // or '/login'
})->name('logout');

// Route::middleware('auth')->prefix('mypage')->name('mypage.')->group(function () {
//     Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
// });
