<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home'); // まずはLaravel既定のwelcomeを出す
});
