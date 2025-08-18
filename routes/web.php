<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create'); // 新規投稿画面
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');        

Route::get('/whoami', fn() => ['auth' => auth()->check(), 'id' => optional(auth()->user())->id]);

require __DIR__.'/auth.php';
