<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\IkiPelangganController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PemasanganController;
use App\Http\Controllers\KolektorController;
use App\Http\Controllers\LoketController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\OdcOdpController;
use App\Http\Controllers\OltController;
use App\Http\Controllers\OnuController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PemasanganTeknisiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemutusanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RouterController;
use App\Http\Controllers\RoutersController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TunggakanController;
use App\Http\Controllers\UbahPaketController;
use App\Http\Controllers\UserController;
use App\Models\Pelanggan;
use App\Models\Pemutusan;
use App\Models\UbahPaket;

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
    return view('auth/login');
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
Route::middleware(['isAuth'])->name('route.')->prefix('route')->group(function () {
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::patch('/roles/{role}/sync-permissions', [RoleController::class, 'syncPermissions'])->name('roles.permissions.sync');
    Route::resource('/permissions', PermissionsController::class)->middleware('role:route');
    Route::post('/permissions/{permission}/roles', [PermissionsController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionsController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::resource('/files', FileManagerController::class);
    Route::resource('/settings', SettingController::class);
    Route::resource('/modules', ModuleController::class);
    Route::resource('/billings', BillingController::class);
    Route::resource('/kolektors', KolektorController::class);
    Route::resource('/lokets', LoketController::class);
    Route::resource('/ubah_pakets', UbahPaketController::class);
    Route::put('/ubahpakets/{id}/update-teknisi', [UbahPaketController::class, 'updateTeknisi'])->name('ubah_pakets.update-teknisi');
    Route::put('/ubahpakets/{id}/update-pembayaran', [UbahPaketController::class, 'pembayaran'])->name('ubah_pakets.pembayaran');
    Route::get('/ubahpakets/{id}/cetak-nota', [UbahPaketController::class, 'pdf'])->name('ubah_pakets.pdf');
    Route::resource('/ikipelanggans', IkiPelangganController::class);
    Route::post('/ubahpaket/store', [UbahPaketController::class, 'store'])->name('ubah_pakets.store');
    Route::put('/ubahpaket/{id}/updateVisit', [UbahPaketController::class, 'updateVisit'])->name('ubah_pakets.visit');
    Route::put('/ubahpaket/{id}/updateStatus', [UbahPaketController::class, 'updateProses'])->name('ubah_pakets.proses');
    Route::get('/ikipelanggans/index1', [PelangganController::class, 'index1'])->name('route.ikipelanggans.index1');
    Route::get('/pelanggans/pdf/{id}', [PelangganController::class, 'pdf'])->name('pelanggans.pdf');
    Route::get('/pelanggans/pdf', [PelangganController::class, 'pdf'])->name('pdf.customer');
    Route::resource('/perbaikans', PerbaikanController::class);
    Route::resource('/pembayarans', PembayaranController::class);
    Route::resource('/tunggakans', TunggakanController::class);
    Route::resource('/routers', RouterController::class);
    Route::resource('/routerss', RoutersController::class);
    Route::resource('/olts', OltController::class);
    Route::resource('/pakets', PaketController::class);
    Route::resource('/odc-odps', OdcOdpController::class);
    Route::resource('/onus', OnuController::class);
    Route::resource('/pembayarans', PembayaranController::class);
    Route::resource('/tunggakans', TunggakanController::class);

    //pemasangan
    Route::get('/pemasangans', [PemasanganController::class, 'index'])->name('pemasangans');
    Route::post('/pemasangans/post', [PemasanganController::class, 'store'])->name('pemasangans.create');
    Route::put('/pemasangans/{id}/update-pemasangan', [PemasanganController::class, 'updatePemasangan'])->name('pemasangans.update');
    Route::put('/pemasangans/{id}/assignment-sales', [PemasanganController::class, 'assignmentSales'])->name('pemasangans.assignment-sales');
    Route::put('/pemasangans/{id}/update-survey', [PemasanganController::class, 'updateSurvey'])->name('pemasangans.update-survey');
    Route::put('/pemasangans/{id}/assignment-teknisi', [PemasanganController::class, 'assignmentTeknisi'])->name('pemasangans.assignment-teknisi');
    Route::put('/pemasangans/{id}/update-instalasi', [PemasanganController::class, 'statusInstalasi'])->name('pemasangans.update-instalasi');
    Route::put('/pemasangans/{id}/update-aktivasi', [PemasanganController::class, 'statusAktivasi'])->name('pemasangans.update-aktivasi');
    Route::put('/pemasangans/{id}/pembayaran', [PemasanganController::class, 'pembayaran'])->name('pemasangans.pembayaran');


    //pelanggan
    Route::get('/pelanggans', [PelangganController::class, 'index'])->name('pelanggans');
    Route::get('/pelanggans/{id}/invoice', [PelangganController::class, 'invoice'])->name('pelanggans.invoice');

    //mutasi
    Route::get('/mutasis', [MutasiController::class, 'index'])->name('mutasis.index');
    Route::post('/mutasis/store', [MutasiController::class, 'store'])->name('mutasis.store');
    Route::put('/mutasis/{id}/assignment-teknisi', [MutasiController::class, 'assignmentTeknisi'])->name('mutasis.assignment-teknisi');
    Route::put('/mutasis/{id}/update-mutasi', [MutasiController::class, 'updateMutasi'])->name('mutasis.status-mutasi');
    Route::put('/mutasis/{id}/pembayaran', [MutasiController::class, 'pembayaran'])->name('mutasis.pembayaran');

    //pemutusan
    Route::get('/pemutusans', [PemutusanController::class, 'index'])->name('pemutusans.index');
    Route::post('/pemutusans/store', [PemutusanController::class, 'store'])->name('pemutusans.store');
    Route::put('/pemutusans/{id}/assignment-teknisi', [PemutusanController::class, 'assignmentTeknisi'])->name('pemutusans.assignment-teknisi');
    Route::put('/pemutusans/{id}/update-pemutusan', [PemutusanController::class, 'updatePemutusan'])->name('pemutusans.status-pemutusan');
    Route::put('/pemutusans/{id}/pembayaran', [PemutusanController::class, 'pembayaran'])->name('pemutusans.pembayaran');

    //perbaikan
    Route::get('/perbaikans', [PerbaikanController::class, 'index'])->name('perbaikans.index');
    Route::get('/perbaikans/berhasil', [PerbaikanController::class, 'berhasil'])->name('perbaikans.berhasil');
    Route::post('/perbaikans/store', [PerbaikanController::class, 'store'])->name('perbaikans.store');
    Route::put('/perbaikans/{id}/assignment-teknisi', [PerbaikanController::class, 'assignmentTeknisi'])->name('perbaikans.assignment-teknisi');
    Route::put('/perbaikans/{id}/update-perbaikan', [PerbaikanController::class, 'updatePerbaikan'])->name('perbaikans.status-perbaikan');
    Route::put('/perbaikans/{id}/pembayaran', [PerbaikanController::class, 'pembayaran'])->name('perbaikans.pembayaran');
});
