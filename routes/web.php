<?php

use Illuminate\Support\Facades\Route;
//Mendefinisikan controller yang digunakan
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GolonganController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UnitKerjaController;
use App\Http\Controllers\Admin\LevelSuratController;
use App\Http\Controllers\OperatorKepegawaian\PenghargaanController;
use App\Http\Controllers\OperatorKepegawaian\AlamatController;
use App\Http\Controllers\OperatorKepegawaian\DiklatPenjenjanganController;
use App\Http\Controllers\OperatorKepegawaian\DokumenPegawaiController;
use App\Http\Controllers\OperatorKepegawaian\HobiController;
use App\Http\Controllers\OperatorKepegawaian\KeteranganBadanController;
use App\Http\Controllers\OperatorKepegawaian\KeteranganKeluargaController;
use App\Http\Controllers\OperatorKepegawaian\KeteranganLainController;
use App\Http\Controllers\OperatorKepegawaian\MertuaController;
use App\Http\Controllers\OperatorKepegawaian\MutasiController;
use App\Http\Controllers\OperatorSurat\OperatorSuratController;
use App\Http\Controllers\OperatorKepegawaian\OperatorKepegawaianController;
use App\Http\Controllers\OperatorKepegawaian\OrangtuaKandungController;
use App\Http\Controllers\OperatorKepegawaian\OrganisasiController;
use App\Http\Controllers\OperatorKepegawaian\PengalamanKeluarNegeriController;
use App\Http\Controllers\OperatorKepegawaian\RiwayatPangkatController;
use App\Http\Controllers\OperatorKepegawaian\RiwayatPendidikanController;
use App\Http\Controllers\OperatorKepegawaian\SaudaraKandungController;
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
Auth::routes([
    //register dimatikan
    'register' => false
]);

//route role 0 = admin
Route::prefix('admin')
    ->middleware('auth','role:0')
    ->group(function(){
         //----Penggguna----
            //admin dashboard
            Route::get('/', [AdminController::class,'index'])->name('admin.index');
            //admin: data pengguna
            Route::get('data-pengguna', [AdminController::class,'data_pengguna'])->name('data-pengguna.index');
            //admin: search pegawai
            Route::get('search-pegawai', [AdminController::class,'search_pegawai'])->name('data-pegawai.search');
            //admin: form tambah pengguna
            Route::get('tambah-pengguna', [AdminController::class,'add_pengguna'])->name('data-pengguna.add');
            //admin: store data pengguna
            Route::post('data-pengguna', [AdminController::class,'store'])->name('data-pengguna.store');
            

        //----Data master----
            //LEVEL SURAT
            Route::resource('data-level_surat', LevelSuratController::class);
            Route::get('get-level_surat', [LevelSuratController::class,'data_level_surat'])->name('data-level_surat.level');
            //UNIT KERJA
            Route::resource('data-unit_kerja', UnitKerjaController::class);
            //GOLONGAN
            Route::resource('data-golongan', GolonganController::class);
            //JABATAN
            Route::resource('data-jabatan', JabatanController::class);
        
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
        //admin: search pegawai
        Route::get('search-pegawai', [AdminController::class,'search_pegawai'])->name('operator-kepegawaian.search');
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
         //operator-kepegawaian: Hapus data pegawai
        Route::delete('data-pegawai/{data_pegawai}',[OperatorKepegawaianController::class,'destroy'])->name('data-pegawai.destroy');
        //operator-kepegawaian: form edit pegawai
        Route::get('edit-data-pegawai/{nip}',[OperatorKepegawaianController::class,'edit'])->name('data-pegawai.edit');
        //operator-kepegawaian: detail data pegawai
        Route::get('show-data-pegawai/{nip}',[OperatorKepegawaianController::class,'show'])->name('data-pegawai.show');
        //operator-kepegawaian: udate data pegawai
        Route::put('edit-data-pegawai/{nip}',[OperatorKepegawaianController::class,'update'])->name('data-pegawai.update');
        //operator-kepegawaian: detail pegawai
        Route::get('detail-data-pegawai/{data_pegawai}',[OperatorKepegawaianController::class,'show'])->name('data-pegawai.show');
        // ---------------------------------hobi-------------------------------------------------
        //operrator-kepegawaian:tambah hobi
        Route::post('edit-data-pegawai-hobi/',[HobiController::class,'store'])->name('data-hobi.store');
        //operator-kepegawain:hapus data hobi
        Route::delete('edit-data-pegawai-alamat/hapushobi/{id_hobi}',[HobiController::class,'destroy'])->name('data-hobi.destroy');
        // ---------------------------------alamat-------------------------------------------------
        // //operrator-kepegawaian:tambah alamat
        Route::post('edit-data-pegawai-alamat/',[AlamatController::class,'store'])->name('data-alamat.store');
        Route::delete('edit-data-pegawai-alamat/hapusalamat/{id_alamat}',[AlamatController::class,'destroy'])->name('data-alamat.destroy');
        Route::get('edit-data-pegawai-alamat/{id_alamat}',[AlamatController::class,'edit'])->name('data-alamat.edit');
        Route::put('edit-data-pegawai-alamat/{id_alamat}',[AlamatController::class,'update'])->name('data-alamat.update');
         // ---------------------------------keterangan badan-------------------------------------------------
        // //operrator-kepegawaian:tambah alamat
        Route::post('edit-data-pegawai-keterangan-badan/',[KeteranganBadanController::class,'store'])->name('data-keterangan-badan.store');
        // //operator-kepegawain:hapus data hobi
        Route::put('edit-data-pegawai-keterangan-badan/editketbadan/{id_badan}',[KeteranganBadanController::class,'update'])->name('data-keterangan-badan.update');
        //-------------------Riwayat pendidikan -------------------------------------------
        Route::resource('riwayat-pendidikan',RiwayatPendidikanController::class);
        // --------------------Keterangan Keluarga------------------------------
        Route::resource('pegawai-keterangan-keluarga',KeteranganKeluargaController::class);
        // -----------------------Orang Tua Kandung---------------------------------
        Route::resource('pegawai-orangtua-kandung',OrangtuaKandungController::class);
        // -----------------------mertua---------------------------------
        Route::resource('pegawai-mertua',MertuaController::class);
        // -----------------------saudara kandung---------------------------------
        Route::resource('pegawai-saudara-kandung',SaudaraKandungController::class);
        // -----------------------penghargaan---------------------------------
        Route::resource('pegawai-penghargaan',PenghargaanController::class);
        // -----------------------penghargaan---------------------------------
        Route::resource('pegawai-pengalaman-keluar-negeri',PengalamanKeluarNegeriController::class);
        // -----------------------organisasi---------------------------------
        Route::resource('pegawai-organisasi',OrganisasiController::class);
         // -----------------------keterangan lain---------------------------------
         Route::resource('pegawai-keterangan-lain',KeteranganLainController::class);
         // -----------------------mutasi---------------------------------
         Route::resource('pegawai-mutasi',MutasiController::class);
         // -----------------------diklat penjenjangan---------------------------------
         Route::resource('pegawai-diklat-penjenjangan',DiklatPenjenjanganController::class);
         // -----------------------riwayat pangkat---------------------------------
         Route::resource('pegawai-riwayat-pangkat',RiwayatPangkatController::class);
         // -----------------------dokumen pegawai---------------------------------
         Route::resource('dokumen-pegawai',DokumenPegawaiController::class);
        
    });



