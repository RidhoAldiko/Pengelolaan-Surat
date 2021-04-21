<?php

use Illuminate\Support\Facades\Route;
//Mendefinisikan controller yang digunakan
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\OperatorKepegawaian\GolonganController;
use App\Http\Controllers\OperatorKepegawaian\JabatanController;
use App\Http\Controllers\OperatorSurat\OperatorSuratController;
use App\Http\Controllers\OperatorKepegawaian\OperatorKepegawaianController;
use App\Http\Controllers\OperatorKepegawaian\UnitKerjaController;
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
        //operator-kepegawaian: form edit pegawai
        Route::get('edit-data-pegawai/{nip}',[OperatorKepegawaianController::class,'edit'])->name('data-pegawai.edit');
        //operator-kepegawaian: udate data pegawai
        Route::put('edit-data-pegawai/{nip}',[OperatorKepegawaianController::class,'update'])->name('data-pegawai.update');
//    ----------------------------------------------------Master Data-----------------------------------------------
        //UNIT KERJA
        //operator-kepegawaian:get table data unit kerja
        Route::get('data-unit-kerja',[UnitKerjaController::class,'index'])->name('data-UnitKerja.index');
        //operator-kepegawaian:form data unit kerja
        Route::get('tambah-unit-kerja',[UnitKerjaController::class,'create'])->name('data-UnitKerja.create');
        //operator-kepegawaian:store data unit kerja
        Route::post('tambah-unit-kerja',[UnitKerjaController::class,'store'])->name('data-UnitKerja.store');
        //operator-kepegawaian:form edit data unit kerja
        Route::get('edit-unit-kerja/{id_unit}',[UnitKerjaController::class,'edit'])->name('data-UnitKerja.edit');
        //operator-kepegawaian:update data unit kerja
        Route::put('edit-unit-kerja/{id_unit}',[UnitKerjaController::class,'update'])->name('data-UnitKerja.update');
        //operator-kepegawaian:delete data unit kerja
        Route::delete('data-unit-kerja/{id_unit}',[UnitKerjaController::class,'destroy'])->name('data-UnitKerja.delete');

        //GOLONGAN
        //operator-kepegawaian:get table data golongan
        Route::get('data-golongan',[GolonganController::class,'index'])->name('data-golongan.index');
        //operator-kepegawaian:form data golongan
        Route::get('tambah-golongan',[GolonganController::class,'create'])->name('data-golongan.create');
        //operator-kepegawaian:store data golongan
        Route::post('tambah-golongan',[GolonganController::class,'store'])->name('data-golongan.store');
        //oprator-kepegawaian: form edit golongan
        Route::get('edit-golongan/{id_golongan}',[GolonganController::class,'edit'])->name('data-golongan.edit');
        //oprator-kepegawaian: update data golongan
        Route::put('edit-golongan/{id_golongan}',[GolonganController::class,'update'])->name('data-golongan.update');
        //operator-kepegawaian:delete data golongan
        Route::delete('data-golongan/{id_golongan}',[GolonganController::class,'destroy'])->name('data-golongan.delete');

        //JABATAN
        //operator-kepegawaian:get table data golongan
        Route::get('data-jabatan',[JabatanController::class,'index'])->name('data-jabatan.index');
        //operator-kepegawaian:form data jabatan
        Route::get('tambah-jabatan',[JabatanController::class,'create'])->name('data-jabatan.create');
        //operator-kepegawaian:store data jabatan
        Route::post('tambah-jabatan',[JabatanController::class,'store'])->name('data-jabatan.store');
        //oprator-kepegawaian: form edit jabatan
        Route::get('edit-jabatan/{id_jabatan}',[JabatanController::class,'edit'])->name('data-jabatan.edit');
        //oprator-kepegawaian: update data jabatan
        Route::put('edit-jabatan/{id_jabatan}',[JabatanController::class,'update'])->name('data-jabatan.update');
        //operator-kepegawaian:delete data jabatan
        Route::delete('data-jabatan/{id_jabatan}',[JabatanController::class,'destroy'])->name('data-jabatan.delete');

        
    });



