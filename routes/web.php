<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JapanController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\DMController;
use App\Http\Controllers\MypageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // 旧リンク互換: /dashboard は /home へ
    // Route::get('/dashboard', fn () => redirect()->route('home'))->name('dashboard');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // 新規投稿画面
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');        
    Route::get('/whoami', fn() => ['auth' => auth()->check(), 'id' => optional(auth()->user())->id]);

    Route::get('/board', [BoardController::class, 'index'])->name('board');

    Route::view('/mypage', 'mypage.index')->name('mypage');

    // 一覧
    Route::get('/dm', [DMController::class, 'index'])->name('dm.index');

    // 詳細（会話IDで開く）← dm.blade.php の route('dm.show', $c) と一致
    Route::get('/dm/{conversation}', [DMController::class, 'show'])->name('dm.show');

    // 送信（会話IDに紐づけて投稿）← route('dm.message.store', $active) と一致
    Route::post('/dm/{conversation}/messages', [DMController::class, 'store'])->name('dm.message.store');

    Route::get('/dm/{conversation}/messages', [DMController::class, 'fetch'])
    ->name('dm.messages.fetch');

    Route::get('/map', function () {
        return view('map'); 
    })->name('map');

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



//検索画面
Route::get('/search', [SearchController::class, 'index'])->name('search.index');



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

// ログアウト／マイページ（認証必須）
Route::middleware('auth')->group(function () {
// ログアウト確認画面
Route::get('/logout/confirm', function () {
    return view('auth.logout-confirm');
})->name('logout.confirm');

// 実際のログアウト処理
Route::post('/logout', function (Request $request) {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home'); // ログイン画面へ戻すなら route('login') でもOK
})->name('logout'); // ← ここを 'logout' に統一

// パスワード
Route::get('/mypage/password',  [PasswordController::class, 'edit'])
    ->name('mypage.password.edit');
Route::put('/mypage/password',  [PasswordController::class, 'update'])
    ->name('mypage.password.update');

// 通知設定
Route::get('/mypage/notifications', [NotificationController::class, 'edit'])
    ->name('mypage.notifications.edit');
Route::patch('/mypage/notifications', [NotificationController::class, 'update'])
    ->name('mypage.notifications.update');

// プロフィール
Route::get('/mypage/profile',  [ProfileController::class, 'edit'])
    ->name('mypage.profile.edit');
Route::patch('/mypage/profile', [ProfileController::class, 'update'])
    ->name('mypage.profile.update');
});




