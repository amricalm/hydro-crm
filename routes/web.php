<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AmanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ActionTargetController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SaleingController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExportController;
use App\Http\Livewire\ActivityChartMounthly;
use App\Http\Controllers\DailyReportController;

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
Auth::routes();
Route::get('/', function () {
    return (!Auth::check()) ? Redirect::route('login') : Redirect::route('home');
});
// Route::get('/', [AmanController::class, 'index'])->name('aman');
Route::get('/keluar', [AmanController::class, 'logout'])->name('aman.keluar');
//===================== ROUTE END INDEX ===========================//

//===================== ROUTE LOGIN ===========================//
Route::post('aman/validasi', [AmanController::class, 'validasi']);
//===================== ROUTE END LOGIN ===========================//

//===================== ROUTE DASHBOARD ===========================//
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('home/export-daily-report',[ExportController::class, 'dailyReport']);
// Route::post('activity-chart-mounthly', ActivityChartMounthly::class);
//===================== ROUTE END DASHBOARD ===========================//

//============================= KARYAWAN ============================//
Route::get('/karyawan', [EmployeController::class, 'index']);
Route::post('/karyawan/getTabel', [EmployeController::class, 'getTabel'])->name('karyawan.getTabel');
Route::post('/karyawan/get', [EmployeController::class, 'get'])->name('employe.get');
Route::post('/karyawan/validation', [EmployeController::class, 'validation']);
Route::post('/karyawan', [EmployeController::class, 'save'])->name('employe.save');
Route::post('/karyawan/delete', [EmployeController::class, 'delete'])->name('employe.delete');
Route::post('/karyawan/isExist', [EmployeController::class, 'isExist'])->name('employe.isExist');
Route::get('/karyawan/export-list-employe',[ExportController::class, 'listEmploye']);
//===================== ROUTE END KARYAWAN ===========================//

//============================= PELANGGAN ============================//
Route::get('/pelanggan', [CustomerController::class, 'index']);
Route::post('/pelanggan/getTabel', [CustomerController::class, 'getTabel'])->name('pelanggan.getTabel');
Route::post('/pelanggan/get', [CustomerController::class, 'get'])->name('customer.get');
Route::post('/pelanggan/validation', [CustomerController::class, 'validation']);
Route::post('/pelanggan/isExist', [CustomerController::class, 'isExist'])->name('customer.isExist');
Route::post('/pelanggan', [CustomerController::class, 'save'])->name('customer.save');
Route::post('/pelanggan/delete', [CustomerController::class, 'delete'])->name('customer.delete');
Route::get('/pelanggan/export',[CustomerController::class, 'template']);
Route::post('/pelanggan/export',[CustomerController::class, 'upload'])->name('customer.upload');
Route::get('/karyawan/export',[CustomerController::class, 'employeList']);
Route::get('/pelanggan/export-list-customer',[ExportController::class, 'listCustomer']);
//===================== ROUTE END PELANGGAN ===========================//

//============================= PRODUK ============================//
Route::get('/produk', [ProductController::class, 'index']);
Route::post('/produk/getTabel', [ProductController::class, 'getTabel'])->name('produk.getTabel');
Route::post('/produk/get', [ProductController::class, 'get'])->name('product.get');
Route::post('/produk/validation', [ProductController::class, 'validation']);
Route::post('/produk', [ProductController::class, 'save'])->name('product.save');
Route::post('/produk/delete', [ProductController::class, 'delete'])->name('product.delete');
Route::post('/produk/isExist', [ProductController::class, 'isExist'])->name('product.isExist');
//===================== ROUTE END PRODUK ===========================//

//============================= JENIS PRODUK ============================//
Route::get('/jenis-produk', [ProductTypeController::class, 'index']);
Route::post('/jenis-produk/getTabel', [ProductTypeController::class, 'getTabel'])->name('product-type.getTabel');
Route::post('/jenis-produk/get', [ProductTypeController::class, 'get'])->name('product-type.get');
Route::post('/jenis-produk/validation', [ProductTypeController::class, 'validation']);
Route::post('/jenis-produk', [ProductTypeController::class, 'save'])->name('product-type.save');
Route::post('/jenis-produk/delete', [ProductTypeController::class, 'delete'])->name('product-type.delete');
Route::post('/jenis-produk/isExist', [ProductTypeController::class, 'isExist'])->name('product-type.isExist');
//===================== ROUTE END JENIS PRODUK ===========================//

//============================= AKSI ============================//
Route::get('/aksi', [ActionController::class, 'index']);
Route::post('/aksi/getTabel', [ActionController::class, 'getTabel'])->name('action.getTabel');
Route::post('/aksi/get', [ActionController::class, 'get'])->name('action.get');
Route::post('/aksi/validation', [ActionController::class, 'validation']);
Route::post('/aksi', [ActionController::class, 'save'])->name('action.save');
Route::post('/aksi/delete', [ActionController::class, 'delete'])->name('action.delete');
Route::post('/aksi/isExist', [ActionController::class, 'isExist'])->name('action.isExist');
//===================== ROUTE END AKSI ===========================//

//============================= PRODUK ============================//
Route::get('/target-aksi', [ActionTargetController::class, 'index']);
Route::post('/target-aksi/getTabel', [ActionTargetController::class, 'getTabel'])->name('action-target.getTabel');
Route::post('/target-aksi/get', [ActionTargetController::class, 'get'])->name('action-target.get');
Route::post('/target-aksi/validation', [ActionTargetController::class, 'validation']);
Route::post('/target-aksi', [ActionTargetController::class, 'save'])->name('action-target.save');
Route::post('/target-aksi/delete', [ActionTargetController::class, 'delete'])->name('action-target.delete');
Route::post('/target-aksi/isExist', [ActionTargetController::class, 'isExist'])->name('action-target.isExist');
//===================== ROUTE END PRODUK ===========================//

//============================= RESPON ============================//
Route::get('/respon', [ResponseController::class, 'index']);
Route::post('respon/getTabel', [ResponseController::class, 'getTabel'])->name('response.getTabel');
Route::post('/respon/get', [ResponseController::class, 'get'])->name('response.get');
Route::post('/respon/validation', [ResponseController::class, 'validation']);
Route::post('/respon', [ResponseController::class, 'save'])->name('response.save');
Route::post('/respon/delete', [ResponseController::class, 'delete'])->name('response.delete');
Route::post('/respon/isExist', [ResponseController::class, 'isExist'])->name('response.isExist');
//===================== ROUTE END RESPON ===========================//

//============================= AKTIVITAS SALES ============================//
Route::get('/aktivitas', [ActivityController::class, 'index']);
Route::post('/aktivitas/getTabel', [ActivityController::class, 'getTabel'])->name('activity.getTabel');
Route::post('/aktivitas/getByCategoryAction', [ActivityController::class, 'getByCategoryAction']);
Route::post('/aktivitas/getCustomer', [ActivityController::class, 'getCustomer']);
Route::post('/aktivitas', [ActivityController::class, 'save_old'])->name('activity.save');
Route::post('/aktivitas/delete', [ActivityController::class, 'delete'])->name('activity.delete');
Route::get('/aktivitas/create', [ActivityController::class, 'create'])->name('activity.create');
Route::post('/aktivitas/create', [ActivityController::class, 'create']);
Route::post('/aktivitas/search', [ActivityController::class, 'search']);
Route::post('/aktivitas/validation', [ActivityController::class, 'validation']);
Route::post('/aktivitas/save', [ActivityController::class, 'save']);
Route::get('/aktivitas/export-report-dtl',[ExportController::class, 'reportDtl']);
//===================== ROUTE END AKTIVITAS SALES ===========================//

//============================= PENJUALAN ============================//
Route::get('/penjualan', [SaleingController::class, 'index']);
Route::post('/penjualan/getTabel', [SaleingController::class, 'getTabel'])->name('saleing.getTabel');
Route::post('/penjualan/get', [SaleingController::class, 'get'])->name('saleing.get');
Route::post('/penjualan/validation', [SaleingController::class, 'validation']);
Route::post('/penjualan/isExist', [SaleingController::class, 'isExist'])->name('saleing.isExist');
Route::post('/penjualan', [SaleingController::class, 'save'])->name('saleing.save');
Route::post('/penjualan/delete', [SaleingController::class, 'delete'])->name('saleing.delete');

Route::post('/penjualan/getCustomer', [SaleingController::class, 'getCustomer']);
Route::get('/penjualan/create', [SaleingController::class, 'create'])->name('saleing.create');
Route::post('/penjualan/search', [SaleingController::class, 'search']);
Route::post('/penjualan/validationCustomer', [SaleingController::class, 'validationCustomer']);
Route::post('/penjualan/saveSaleing', [SaleingController::class, 'saveSaleing']);
//===================== ROUTE END PENJUALAN ===========================//

//============================= PENGGUNA ============================//
Route::get('/pengguna', [UsersController::class, 'index']);
Route::post('/pengguna/getTabel', [UsersController::class, 'getTabel'])->name('users.getTabel');
Route::post('/pengguna/get', [UsersController::class, 'get'])->name('users.get');
Route::post('/pengguna/validation', [UsersController::class, 'validation']);
Route::post('/pengguna', [UsersController::class, 'save'])->name('users.save');
Route::post('/pengguna/delete', [UsersController::class, 'delete'])->name('users.delete');
Route::post('/pengguna/isExist', [UsersController::class, 'isExist'])->name('users.isExist');
//===================== ROUTE END PENGGUNA ===========================//


Route::get('/clear-cache', function () {
    $configCache = Artisan::call('config:cache');
    $clearCache = Artisan::call('cache:clear');
    $routeCache = Artisan::call('route:clear');
    $viewCache = Artisan::call('view:clear');
    echo 'Berhasil';
});
