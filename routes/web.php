<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/whoami', fn() => ['auth' => auth()->check(), 'id' => optional(auth()->user())->id]);

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
