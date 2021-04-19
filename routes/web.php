<?php

use Illuminate\Support\Facades\Route;
//Mendefinisikan controller yang digunakan
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\OperatorSurat\OperatorSuratController;
use App\Http\Controllers\OperatorKepegawaian\OperatorKepegawaianController;
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
//Route root
Route::get('/', [AdminController::class,'index'])->middleware('auth','role:0');

//route authentication
Auth::routes();

//route role 0 = admin
Route::prefix('admin')
    ->middleware('auth','role:0')
    ->group(function(){
        //admin dashboard
        Route::get('/', [AdminController::class,'index'])->name('admin.index');
        //admin: data pengguna
        Route::get('data-pengguna', [AdminController::class,'data_pengguna'])->name('data-pengguna.index');
        //admin: form tambah pengguna
        Route::get('tambah-pengguna', [AdminController::class,'add_pengguna'])->name('data-pengguna.add');
        
    });

//route role 1 = operator surat
Route::prefix('operator-surat')
    ->middleware('auth','role:1')
    ->group(function(){
        //operator-surat dashboard
        Route::get('/', [OperatorSuratController::class,'index'])->name('operator-surat.index');
    });

//route role 2 = operator-kepegawaian 
Route::prefix('operator-kepegawaian')
    ->middleware('auth','role:2')
    ->group(function(){
        //operator-kepegawaian dashboard
        Route::get('/', [OperatorKepegawaianController::class,'index'])->name('operator-kepegawaian.index');
        //operator-kepegawaian: table data pegawai
        Route::get('data-pegawai', [OperatorKepegawaianController::class,'data_pegawai'])->name('data-pegawai.index');
        //operator-kepegawaian: get server side data pegawai
        Route::get('serverside-pegawai',[OperatorKepegawaianController::class,'pegawai_serverSide'])->name('pegawai.serverside');
        //operator-kepegawaian: form data pegawai
        Route::get('tambah-pegawai', [OperatorKepegawaianController::class,'add_pegawai'])->name('data-pegawai.add');
        //operator-kepegawaian: store data pegawai
        Route::post('tambah-pegawai', [OperatorKepegawaianController::class,'store_pegawai'])->name('data-pegawai.store');
    });



