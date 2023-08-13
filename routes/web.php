<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('login');
// });
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

// Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
// route::get('/login', [LoginController::class, 'halamanlogin']);
// route::post('/postlogin', [LoginController::class, 'postlogin'])->name('postlogin');

Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(UserController::class)->prefix('dataMaster')->group(function () {
        Route::get('', 'user')->name('dataMaster');
        Route::post('save', 'save')->name('dataMaster.save');
        Route::post('edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });
});
