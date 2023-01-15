<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);
    



Route::get('/#', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/signup', function () {
    return view('signup');
});
Route::get('/', function () {
    return view('index');
});
Route::get('/index2', function () {
    return view('index2');
});

Route::get('/login2', function () {
    return view('login2');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/home', function () {
    return view('home');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
