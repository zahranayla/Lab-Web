<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/contact', function () {
    return view('contact');
});
