<?php

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
use App\Http\Controllers\PengampuanController;
use App\Http\Controllers\ProfilLulusanController;

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

Route::get('/', [DashboardController::class, 'landing'])->name('landing');
Route::get('/login', [LoginController::class, 'create'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'store'])->middleware('guest')->name('login.post');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

// Route that need auth
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
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

    // Show 3D


    //ProfilLulusan
    Route::get('/profil-lulusan', [ProfilLulusanController::class, 'index'])->name('profil.lulusan.index');
    Route::get('/profil-lulusan/create', [ProfilLulusanController::class, 'create'])->name('profil.lulusan.create');
    Route::post('/profil-lulusan/create', [ProfilLulusanController::class, 'store'])->name('profil.lulusan.store');
    Route::get('/profil-lulusan/{id}/edit', [ProfilLulusanController::class, 'edit'])->name('profil.lulusan.edit');
    Route::post('/profil-lulusan/{id}/edit', [ProfilLulusanController::class, 'update'])->name('profil.lulusan.update');
    Route::delete('/profil-lulusan/{id}', [ProfilLulusanController::class, 'destroy'])->name('profil.lulusan.destroy');

    //CapaianProfilLulusan
    Route::get('/capaian-profil-lulusan', [CPLController::class, 'index'])->name('cpl.index');
    Route::get('/capaian-profil-lulusan/create', [CPLController::class, 'create'])->name('cpl.create');
    Route::post('/capaian-profil-lulusan/create', [CPLController::class, 'store'])->name('cpl.store');
    Route::get('/capaian-profil-lulusan/{id}/edit', [CPLController::class, 'edit'])->name('cpl.edit');
    Route::post('/capaian-profil-lulusan/{id}/edit', [CPLController::class, 'update'])->name('cpl.update');
    Route::delete('/capaian-profil-lulusan/{id}', [CPLController::class, 'destroy'])->name('cpl.destroy');

    //BahanKajian
    Route::get('/bahan-kajian', [BahanKajianController::class, 'index'])->name('bahan.kajian.index');
    Route::get('/bahan-kajian/create', [BahanKajianController::class, 'create'])->name('bahan.kajian.create');
    Route::post('/bahan-kajian/create', [BahanKajianController::class, 'store'])->name('bahan.kajian.store');
    Route::get('/bahan-kajian/{id}/edit', [BahanKajianController::class, 'edit'])->name('bahan.kajian.edit');
    Route::post('/bahan-kajian/{id}/edit', [BahanKajianController::class, 'update'])->name('bahan.kajian.update');
    Route::delete('/bahan-kajian/{id}', [BahanKajianController::class, 'destroy'])->name('bahan.kajian.destroy');

    //MataKuliah
    Route::get('/mata-kuliah', [MataKuliahController::class, 'index'])->name('mk.index');
    Route::get('/mata-kuliah/create', [MataKuliahController::class, 'create'])->name('mk.create');
    Route::post('/mata-kuliah/create', [MataKuliahController::class, 'store'])->name('mk.store');
    Route::get('/mata-kuliah/{id}/edit', [MataKuliahController::class, 'edit'])->name('mk.edit');
    Route::post('/mata-kuliah/{id}/edit', [MataKuliahController::class, 'update'])->name('mk.update');
    Route::delete('/mata-kuliah/{id}', [MataKuliahController::class, 'destroy'])->name('mk.destroy');

    // Pengampuan
    Route::get('/pengampuan', [PengampuanController::class, 'index'])->name('pengampuan.index');
    Route::post('/pengampuan', [PengampuanController::class, 'index'])->name('pengampuan.store');
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
    Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/create', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('/role/{id}/edit', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
});

// Dosen
Route::middleware('auth', 'check.roles:super_admin')->group(function () {
    //CPMK
    Route::get('/cpmk', [CPMKController::class, 'index'])->name('cpmk.index');
    Route::get('/cpmk/create', [CPMKController::class, 'create'])->name('cpmk.create');
    Route::post('/cpmk/create', [CPMKController::class, 'store'])->name('cpmk.store');
    Route::get('/cpmk/{id}/edit', [CPMKController::class, 'edit'])->name('cpmk.edit');
    Route::post('/cpmk/{id}/edit', [CPMKController::class, 'update'])->name('cpmk.update');
    Route::delete('/cpmk/{id}', [CPMKController::class, 'destroy'])->name('cpmk.destroy');

    //Sub-CPMK
    Route::get('/sub-cpmk', [SubCPMKController::class, 'index'])->name('subcpmk.index');
    Route::get('/sub-cpmk/create', [SubCPMKController::class, 'create'])->name('subcpmk.create');
    Route::post('/sub-cpmk/create', [SubCPMKController::class, 'store'])->name('subcpmk.store');
    Route::get('/sub-cpmk/{id}/edit', [SubCPMKController::class, 'edit'])->name('subcpmk.edit');
    Route::post('/sub-cpmk/{id}/edit', [SubCPMKController::class, 'update'])->name('subcpmk.update');
    Route::delete('/sub-cpmk/{id}', [SubCPMKController::class, 'destroy'])->name('subcpmk.destroy');
});
