<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ActivityController;

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

//============================= KARYAWAN ============================//
Route::get('/karyawan', [EmployeController::class, 'index']);
Route::post('karyawan/getTabel', [EmployeController::class, 'getTabel']);
Route::post('/karyawan/get', [EmployeController::class, 'get'])->name('employe.get');
Route::post('/karyawan', [EmployeController::class, 'save'])->name('employe.save');
Route::post('/karyawan/delete', [EmployeController::class, 'delete'])->name('employe.delete');
Route::post('/karyawan/isExist', [EmployeController::class, 'isExist'])->name('employe.isExist');
//===================== ROUTE END KARYAWAN ===========================//

//============================= PELANGGAN ============================//
Route::get('/pelanggan', [CustomerController::class, 'index']);
Route::post('pelanggan/getTabel', [CustomerController::class, 'getTabel']);
Route::post('/pelanggan/get', [CustomerController::class, 'get'])->name('customer.get');
Route::post('/pelanggan', [CustomerController::class, 'save'])->name('customer.save');
Route::post('/pelanggan/delete', [CustomerController::class, 'delete'])->name('customer.delete');
Route::post('/pelanggan/isExist', [CustomerController::class, 'isExist'])->name('customer.isExist');
//===================== ROUTE END PELANGGAN ===========================//


//============================= PRODUK ============================//
Route::get('/produk', [ProductController::class, 'index']);
Route::post('produk/getTabel', [ProductController::class, 'getTabel']);
Route::post('/produk/get', [ProductController::class, 'get'])->name('product.get');
Route::post('/produk', [ProductController::class, 'save'])->name('product.save');
Route::post('/produk/delete', [ProductController::class, 'delete'])->name('product.delete');
Route::post('/produk/isExist', [ProductController::class, 'isExist'])->name('product.isExist');
//===================== ROUTE END PRODUK ===========================//

//============================= JENIS PRODUK ============================//
Route::get('/jenis-produk', [ProductTypeController::class, 'index']);
Route::post('jenis-produk/getTabel', [ProductTypeController::class, 'getTabel']);
Route::post('/jenis-produk/get', [ProductTypeController::class, 'get'])->name('product-type.get');
Route::post('/jenis-produk', [ProductTypeController::class, 'save'])->name('product-type.save');
Route::post('/jenis-produk/delete', [ProductTypeController::class, 'delete'])->name('product-type.delete');
Route::post('/jenis-produk/isExist', [ProductTypeController::class, 'isExist'])->name('product-type.isExist');
//===================== ROUTE END JENIS PRODUK ===========================//

//============================= AKSI ============================//
Route::get('/aksi', [ActionController::class, 'index']);
Route::post('aksi/getTabel', [ActionController::class, 'getTabel']);
Route::post('/aksi/get', [ActionController::class, 'get'])->name('action.get');
Route::post('/aksi', [ActionController::class, 'save'])->name('action.save');
Route::post('/aksi/delete', [ActionController::class, 'delete'])->name('action.delete');
Route::post('/aksi/isExist', [ActionController::class, 'isExist'])->name('action.isExist');
//===================== ROUTE END AKSI ===========================//

//============================= RESPON ============================//
Route::get('/respon', [ResponseController::class, 'index']);
Route::post('respon/getTabel', [ResponseController::class, 'getTabel']);
Route::post('/respon/get', [ResponseController::class, 'get'])->name('response.get');
Route::post('/respon', [ResponseController::class, 'save'])->name('response.save');
Route::post('/respon/delete', [ResponseController::class, 'delete'])->name('response.delete');
Route::post('/respon/isExist', [ResponseController::class, 'isExist'])->name('response.isExist');
//===================== ROUTE END RESPON ===========================//


//============================= PELANGGAN ============================//
Route::get('/aktivitas', [ActivityController::class, 'index']);
Route::post('aktivitas/getTabel', [ActivityController::class, 'getTabel']);
Route::post('/aktivitas/get', [ActivityController::class, 'get'])->name('aktivitas.get');
Route::post('/aktivitas', [ActivityController::class, 'save'])->name('aktivitas.save');
Route::post('/aktivitas/delete', [ActivityController::class, 'delete'])->name('aktivitas.delete');
Route::post('/aktivitas/isExist', [ActivityController::class, 'isExist'])->name('aktivitas.isExist');
//===================== ROUTE END PELANGGAN ===========================//

