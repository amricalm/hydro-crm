<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmanController;
use App\Http\Controllers\DashboardController;

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

//===================== ROUTE INDEX ===========================//
Route::get('/', [AmanController::class, 'index'])->name('aman');
Route::get('/keluar', [AmanController::class, 'logout'])->name('aman.keluar');
//===================== ROUTE END INDEX ===========================//

//===================== ROUTE LOGIN ===========================//
Route::post('aman/validasi', [AmanController::class, 'validasi']);
//===================== ROUTE END LOGIN ===========================//

//===================== ROUTE DASHBOARD ===========================//
Route::post('beranda',  [DashboardController::class, 'index'])->name("beranda");
//===================== ROUTE END DASHBOARD ===========================//
