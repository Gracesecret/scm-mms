<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GRController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MRController;
use App\Http\Controllers\OcraController;
use App\Http\Controllers\POController;
use App\Http\Controllers\PRController;
use App\Http\Controllers\SuplierController;
use App\Models\Material;
use App\Models\Purchaseorder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// dashboard
Route::get('/dashboardadmin', [App\Http\Controllers\HomeController::class, 'indexadmin'])->name('homeadmin');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboardmain', [App\Http\Controllers\HomeController::class, 'indexmain'])->name('homemain');
// Manajemen Admin
Route::get('/list-user', [AdminController::class, 'listuser'])->name('list-user');
Route::get('/list-budget', [AdminController::class, 'listbudget'])->name('list-budget');
Route::put('/update-budget/{id}', [AdminController::class, 'updatebudget'])->name('update-budget');
Route::put('/request-budget/{id}', [AdminController::class, 'requestbudget'])->name('request-budget');
Route::get('/hapus-user/{id}', [AdminController::class, 'hapususer'])->name('hapus-user');
Route::put('/edit-user/{id}', [AdminController::class, 'edituser'])->name('edit-user');
Route::get('/list-dept', [AdminController::class, 'listdept'])->name('list-dept');
Route::post('/create-user', [AdminController::class, 'create'])->name('regist-user');
Route::post('/create-dept', [AdminController::class, 'tambahdept'])->name('regist-dept');
// 
// Manajemen Supplier
Route::post('/create-supplier', [SuplierController::class, 'create'])->name('create-supplier');
Route::put('/update-supplier/{id}', [SuplierController::class, 'update'])->name('update-supplier');
Route::get('/list-supplier', [SuplierController::class, 'listsuplier'])->name('list-supplier');
Route::get('/add-supplier', [SuplierController::class, 'viewaddsupplier'])->name('add-supplier');
Route::get('/hapus-supplier/{id}', [SuplierController::class, 'deletesupplier'])->name('hapus-supplier');
// 
// Manajemen Material
Route::get('list-material',[MaterialController::class,'listmaterial'])->name('list-material');
Route::get('/hapus-material/{id}', [MaterialController::class, 'delete'])->name('hapus-material');
Route::get('/detail-material/{id}', [MaterialController::class, 'detailmaterial'])->name('detail-material');
Route::get('/add-material', [MaterialController::class, 'viewaddmaterial'])->name('add-material');
Route::post('/create-material', [MaterialController::class, 'create'])->name('create-material');
Route::put('/update-material/{id}', [MaterialController::class, 'update'])->name('update-material');
Route::get('material-keluar/{id}',[MaterialController::class,'materialkeluar'])->name('view-material-keluar');
Route::post('/simpan-keluar', [MaterialController::class, 'simpankeluar'])->name('material-keluar');
Route::post('list-materialkeluar',[MaterialController::class,'searchbetweenkeluar']);
Route::post('list-materialmasuk',[MaterialController::class,'searchbetweenmasuk']);
Route::get('list-materialkeluar',[MaterialController::class,'listmaterialkeluar'])->name('list-materialkeluar');
Route::get('list-materialmasuk',[MaterialController::class,'listmaterialmasuk'])->name('list-materialmasuk');
Route::get('list-prpo',[MaterialController::class,'listprpo'])->name('list-prpo');
Route::get('minstok',[MaterialController::class,'minstok'])->name('minstok');
Route::get('history-keluar/{id}',[MaterialController::class,'historykeluar'])->name('historykeluar');
Route::get('history-prpo/{id}',[MaterialController::class,'historyprpo'])->name('historyprpo');
//
// Manajemen MR
Route::get('list-mr',[MRController::class,'listmr'])->name('list-mr');
Route::get('hapus-mr/{id}',[MRController::class,'hapusmr'])->name('hapus-mr');
Route::get('pending-mr',[MRController::class,'pendingmr'])->name('pending-mr');
Route::get('approved-mr',[MRController::class,'approvedmr'])->name('approved-mr');
Route::get('proses-mr/{id}',[MRController::class,'prosesmr'])->name('proses-mr');
Route::get('formadd-mr',[MRController::class,'formadd'])->name('formadd-mr');
Route::post('create-mr',[MRController::class,'simpanmr'])->name('create-mr');
Route::post('simpanedit-mr',[MRController::class,'simpaneditmr'])->name('simpanedit-mr');
Route::get('mr-print/{id}',[MRController::class,'printmr'])->name('mr.print');
Route::get('detail-mr/{id}',[MRController::class,'detailmr'])->name('detail-mr');
// 
// Manajemen PR
Route::get('list-pr',[PRController::class,'listpr'])->name('list-pr');
Route::get('approved-pr',[PRController::class,'approvedpr'])->name('approved-pr');
Route::get('pending-pr',[PRController::class,'pendingpr'])->name('pending-pr');
Route::get('formadd-pr',[PRController::class,'formadd'])->name('formadd-pr');
Route::get('hapus-pr/{id}',[PRController::class,'hapuspr'])->name('hapus-pr');
Route::post('create-pr',[PRController::class,'createpr'])->name('create-pr');
Route::get('pr-print/{id}',[PRController::class,'printpr'])->name('pr.print');
Route::get('proses-pr/{id}',[PRController::class,'prosespr'])->name('proses-pr');
Route::post('simpanprosespr',[PRController::class,'simpanprosespr'])->name('simpanprosespr');
Route::get('detail-pr/{id}',[PRController::class,'detailpr'])->name('detail-pr');
// 
// Manajemen PO
Route::get('list-po',[POController::class,'listpo'])->name('list-po');
Route::get('pending-po',[POController::class,'pendingpo'])->name('pending-po');
Route::get('received-po',[POController::class,'receivedpo'])->name('received-po');
Route::get('add-po/{id}',[POController::class,'addpo'])->name('add-po');
Route::get('addbypr-po/{id}',[POController::class,'addpobypr'])->name('addbypr-po');
Route::get('print-po/{id}',[POController::class,'printpo'])->name('print-po');
Route::get('detail-po/{id}',[POController::class,'detailpo'])->name('detail-po');
Route::get('proses-po/{id}',[POController::class,'prosespo'])->name('proses-po');
Route::post('simpanprosespo',[POController::class,'simpanprosespo'])->name('simpanprosespo');
Route::post('create-po',[POController::class,'savepo'])->name('create-po');
Route::post('savepobypr',[POController::class,'savepobypr'])->name('savepobypr');
// 
// Manajemen GR
Route::get('list-gr',[GRController::class,'listgr'])->name('list-gr');
Route::get('print-gr/{id}',[GRController::class,'printgr'])->name('print-gr');
Route::get('detail-gr/{id}',[GRController::class,'detailgr'])->name('detail-gr');
Route::get('formadd-gr',[GRController::class,'formadd'])->name('formadd-gr');
Route::get('edit-gr/{id}',[GRController::class,'editgr'])->name('edit-gr');
Route::post('simpan-gr',[GRController::class,'simpangr'])->name('simpan-gr');
Route::post('simpanedit-gr',[GRController::class,'simpaneditgr'])->name('simpaneditgr');

// metode ocra
Route::get('ocra',[OcraController::class,'index'])->name('ocra');