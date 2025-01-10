<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('HomePage');
})->name('HomePage');

Route::get('/Profile', function () {
    return view('Profile');
})->name('Profile');

Route::get('/CreatePost', function () {
    return view('CreatePost');
})->name('CreatePost');

Route::get("/Login", function () {
    return view('Login');
})->name('Login');

Route::get('/About', function () {
    return view('About');
})->name('About');

Route::get('/Contact', function () {
    return view('Contact');
})->name('Contact');

Route::get('/Register', function(){
    return view('Register');
})->name('Register');