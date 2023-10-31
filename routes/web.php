<?php

use App\Http\Controllers\AlurInputDosenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CPLController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\CPMKController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubCPMKController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\BahanKajianController;
use App\Http\Controllers\DeskripsiRpsController;
use App\Http\Controllers\IndikatorDeskripsiRpsController;
use App\Http\Controllers\PengampuanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\RpsController;

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

// Route::get('/', [DashboardController::class, 'landing'])->name('landing');
Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.post');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// Route that need auth
Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

// Koor Prodi (Main Feature is Here)
Route::middleware('auth', 'check.roles:koor_prodi')->group(function () {
    // Maping 2D
    Route::get('/cpl_pl', [MapController::class, 'cplToPl'])->name('map.cpl.pl');
    Route::post('/cpl_pl', [MapController::class, 'mapingCplToPl'])->name('maping.cpl.pl');

    Route::get('/bk_cpl', [MapController::class, 'bkToCpl'])->name('map.bk.cpl');
    Route::post('/bk_cpl', [MapController::class, 'mapingBkToCpl'])->name('maping.bk.cpl');

    Route::get('/bk_mk', [MapController::class, 'bkToMk'])->name('map.bk.mk');
    Route::post('/bk_mk', [MapController::class, 'mapingBkToMk'])->name('maping.bk.mk');

    Route::get('/cpl_mk', [MapController::class, 'cplToMk'])->name('map.cpl.mk');
    Route::post('/cpl_mk', [MapController::class, 'mapingCplToMk'])->name('maping.cpl.mk');

    Route::get('/cpmk_mk', [MapController::class, 'cpmkToMk'])->name('map.cpmk.mk');
    Route::post('/cpmk_mk', [MapController::class, 'mapingCpmkToMk'])->name('maping.cpmk.mk');

    // Show 3D
    Route::get('/bk_cpl_mk', [MapController::class, 'bkCplMk'])->name('map.bk.cpl.mk');
    Route::get('/cpl_cpmk_mk', [MapController::class, 'cplCpmkMk'])->name('map.cpl.cpmk.mk');


    // ProfilLulusan
    Route::get('/profil-lulusan', [ProfilLulusanController::class, 'index'])->name('profil.lulusan.index');
    Route::post('/profil-lulusan/create', [ProfilLulusanController::class, 'store'])->name('profil.lulusan.store');
    Route::post('/profil-lulusan/{id}/edit', [ProfilLulusanController::class, 'update'])->name('profil.lulusan.update');
    Route::delete('/profil-lulusan/{id}', [ProfilLulusanController::class, 'destroy'])->name('profil.lulusan.destroy');

    // CapaianProfilLulusan
    Route::get('/capaian-profil-lulusan', [CPLController::class, 'index'])->name('cpl.index');
    Route::post('/capaian-profil-lulusan/create', [CPLController::class, 'store'])->name('cpl.store');
    Route::post('/capaian-profil-lulusan/{id}/edit', [CPLController::class, 'update'])->name('cpl.update');
    Route::delete('/capaian-profil-lulusan/{id}', [CPLController::class, 'destroy'])->name('cpl.destroy');

    // BahanKajian
    Route::get('/bahan-kajian', [BahanKajianController::class, 'index'])->name('bk.index');
    Route::post('/bahan-kajian/create', [BahanKajianController::class, 'store'])->name('bk.store');
    Route::post('/bahan-kajian/{id}/edit', [BahanKajianController::class, 'update'])->name('bk.update');
    Route::delete('/bahan-kajian/{id}', [BahanKajianController::class, 'destroy'])->name('bk.destroy');

    // MataKuliah
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mk.index');
    Route::post('/mata-kuliah/create', [MataKuliahController::class, 'store'])->name('mk.store');
    Route::post('/mata-kuliah/{id}/edit', [MataKuliahController::class, 'update'])->name('mk.update');
    Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mk.destroy');

    // CPMK
    Route::get('/cpmk', [CPMKController::class, 'index'])->name('cpmk.index');
    Route::post('/cpmk/create', [CPMKController::class, 'store'])->name('cpmk.store');
    Route::post('/cpmk/{id}/edit', [CPMKController::class, 'update'])->name('cpmk.update');
    Route::delete('/cpmk/{id}', [CPMKController::class, 'destroy'])->name('cpmk.destroy');

    // Pengampuan
    Route::get('/pengampuan', [PengampuanController::class, 'index'])->name('pengampuan.index');
    Route::post('/pengampuan', [PengampuanController::class, 'store'])->name('pengampuan.store');
});

// Superadmin (crud only)
Route::middleware('auth', 'check.roles:super_admin')->group(function () {
    // Users
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user/{id}/edit', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Role
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');

    // Prodi
    Route::get('/prodi', [ProdiController::class, 'index'])->name('prodi.index');
    Route::get('/prodi/create', [ProdiController::class, 'create'])->name('prodi.create');
    Route::post('/prodi/create', [ProdiController::class, 'store'])->name('prodi.store');
    Route::get('/prodi/{id}/edit', [ProdiController::class, 'edit'])->name('prodi.edit');
    Route::post('/prodi/{id}/edit', [ProdiController::class, 'update'])->name('prodi.update');
    Route::delete('/prodi/{id}', [ProdiController::class, 'destroy'])->name('prodi.destroy');
});

// Dosen
Route::middleware('auth', 'check.roles:dosen')->group(function () {
    //Sub-CPMK
    // Route::post('/sub-cpmk/create', [SubCPMKController::class, 'store'])->name('subcpmk.store');
    Route::post('/sub-cpmk/{id}/edit', [SubCPMKController::class, 'update'])->name('subcpmk.update');
    // Route::delete('/sub-cpmk/{id}', [SubCPMKController::class, 'destroy'])->name('subcpmk.destroy');

    // Alur Mengisi
    Route::get('/list_mk', [AlurInputDosenController::class, 'listMatakuliah'])->name('dosen.list.mk');
    Route::get('/sub_cpmk/{id_mk}', [AlurInputDosenController::class, 'listSubCpmk'])->name('dosen.list.subcpmk');

    // RPS
    Route::post('/rps/generate_rps/{id_mk}', [RpsController::class, 'generateRps'])->name('rps.generate');
    Route::get('/rps/list_mk', [RpsController::class, 'listMatakuliah'])->name('rps.list.mk');
    Route::get('/rps/{id_mk}', [RpsController::class, 'index'])->name('rps.index');
    // Deskripsi RPS
    Route::post('/deskripsi_rps/{id}', [DeskripsiRpsController::class, 'update'])->name('desk.rps.update');
    Route::post('/deskripsi_rps', [DeskripsiRpsController::class, 'updateAll'])->name('desk.rps.update.all');
    // Indikator Deskripsi RPS
    Route::post('/indikator-rps/{id_deskripsi_rps}/create', [IndikatorDeskripsiRpsController::class, 'store'])->name('indikator.rps.store');
    Route::delete('/indikator-rps/{id_sub_cpmk}/{id_indikator_rps}', [IndikatorDeskripsiRpsController::class, 'destroy'])->name('indikator.rps.destroy');
});
