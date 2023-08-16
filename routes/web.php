<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
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

    Route::get('login', 'login')->name('login')->middleware('isNoAuth');
    Route::post('login', 'loginAction')->name('login.action');

    Route::get('logout', 'logout')->middleware('auth')->name('logout')->middleware('isAuth');
});

Route::middleware('isAuth')->group(function () {
    // Route::get('dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');




    Route::controller(UserController::class)->prefix('dataMaster')->group(function () {
        Route::get('', 'user')->name('dataMaster');
        Route::post('save', 'save')->name('dataMaster.save');
        Route::post('edit/{id}', 'edit');
        Route::get('delete/{id}', 'delete');
    });
});

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware(['isAuth']);
Route::middleware(['isAuth'])->name('super admin.')->prefix('super admin')->group(function () {
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::patch('/roles/{role}/sync-permissions', [RoleController::class, 'syncPermissions'])->name('roles.permissions.sync');
    Route::resource('/permissions', PermissionsController::class);
    Route::post('/permissions/{permission}/roles', [PermissionsController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionsController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::resource('/files', FileManagerController::class);
    Route::resource('/settings', SettingController::class);
});
