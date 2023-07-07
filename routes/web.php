<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
