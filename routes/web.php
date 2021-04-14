<?php

use Illuminate\Support\Facades\Route;
//Mendefinisikan controller yang digunakan
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OperatorSuratController;
use App\Http\Controllers\OperatorKepegawaianController;
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
        Route::get('/', [AdminController::class,'index'])
            ->name('admin.index');
    });

//route role 1 = operator surat
Route::prefix('operator-surat')
    ->middleware('auth','role:1')
    ->group(function(){
        //operator-surat dashboard
        Route::get('/', [OperatorSuratController::class,'index'])
            ->name('operator-surat.index');
    });

//route role 2 = operator-kepegawaian 
Route::prefix('operator-kepegawaian')
    ->middleware('auth','role:2')
    ->group(function(){
        //operator-kepegawaian dashboard
        Route::get('/', [OperatorKepegawaianController::class,'index'])
            ->name('operator-kepegawaian.index');
    });



