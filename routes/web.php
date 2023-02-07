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

Auth::routes();

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index']);

Route::get('/', [App\Http\Controllers\IndexController::class, 'index'])->name('index');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('admin');

    Route::get('/users/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users');
    Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}/destroy', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name(
        'users.destroy'
    );

    Route::get('/stroller/', [App\Http\Controllers\Admin\StrollerController::class, 'index'])->name('stroller');
    Route::get('/stroller/create', [App\Http\Controllers\Admin\StrollerController::class, 'create'])->name(
        'stroller.create'
    );
    Route::post('/stroller/store', [App\Http\Controllers\Admin\StrollerController::class, 'store'])->name(
        'stroller.store'
    );
    Route::delete('/stroller/{stroller}/destroy', [App\Http\Controllers\Admin\StrollerController::class, 'destroy']
    )->name(
        'stroller.destroy'
    );
    Route::get('/stroller/{stroller}/edit', [App\Http\Controllers\Admin\StrollerController::class, 'edit']
    )->name(
        'stroller.edit'
    );
    Route::post('/stroller/{stroller}/update', [App\Http\Controllers\Admin\StrollerController::class, 'update']
    )->name(
        'stroller.update'
    );
    Route::get('/reservation/', [App\Http\Controllers\Admin\ReservationController::class, 'list'])->name('reservation');
    Route::get(
        '/reservation/{reservation}/approve',
        [App\Http\Controllers\Admin\ReservationController::class, 'approve']
    )->name('reservation.approve');
    Route::get(
        '/reservation/{reservation}/cancel',
        [App\Http\Controllers\Admin\ReservationController::class, 'cancel']
    )->name('admin.reservation.cancel');
    Route::get(
        '/reservation/{reservation}/view',
        [App\Http\Controllers\Admin\ReservationController::class, 'view']
    )->name('reservation.view');
})->middleware(['auth', 'admin']);

Route::post('/reservation/{stroller}/submit', [\App\Http\Controllers\ReservationController::class, 'submit']
)->name(
    'reservation.submit'
);

Route::get('/reservation/list', [\App\Http\Controllers\ReservationController::class, 'list']
)->name(
    'reservation.list'
);

Route::get('/reservation/{reservation}/cancel', [\App\Http\Controllers\ReservationController::class, 'cancel']
)->name(
    'reservation.cancel'
);

Route::get('/login', function () {
    return redirect('/');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('submit_login');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
