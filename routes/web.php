<?php

use Illuminate\Support\Facades\Route;
//Mendefinisikan controller yang digunakan
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GajiController;
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
use App\Http\Controllers\OperatorSurat\SuratMasukController;
use App\Http\Controllers\OperatorKepegawaian\OperatorKepegawaianController;
use App\Http\Controllers\OperatorKepegawaian\OrangtuaKandungController;
use App\Http\Controllers\OperatorKepegawaian\OrganisasiController;
use App\Http\Controllers\OperatorKepegawaian\PengalamanKeluarNegeriController;
use App\Http\Controllers\OperatorKepegawaian\RiwayatKGBController;
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
            //GAJI
            Route::resource('data-gaji', GajiController::class);
        
    });

//route role 1 = operator surat
Route::prefix('operator-surat')
    ->middleware('auth','role:1')
    ->group(function(){
        //admin: search pegawai
        Route::get('search-pengguna', [SuratMasukController::class,'search_pengguna'])->name('operator-surat.search');
        //operator-surat dashboard
        Route::get('/', [OperatorSuratController::class,'index'])->name('operator-surat.index');
        //operator-surat tabel surat masuk
    // ---------------------------------Surat Masuk-------------------------------------------------
        Route::get('surat-masuk', [SuratMasukController::class,'index'])->name('surat-masuk.index');
        // operator-surat form surat masuk 
        Route::get('surat-masuk-create', [SuratMasukController::class,'create'])->name('surat-masuk.create');
        // operator-surat store surat masuk 
        Route::post('surat-masuk-create', [SuratMasukController::class,'store'])->name('surat-masuk.store');
        // operator-surat server side form surat 
        Route::get('serverside-surat-masuk',[SuratMasukController::class,'surat_masuk_serverside'])->name('surat-masuk.serverside');
        // operator-surat edit surat masuk 
        Route::get('edit-surat-masuk/{id}',[SuratMasukController::class,'edit'])->name('surat-masuk.edit');
    // ---------------------------------Disposisi Surat Masuk-------------------------------------------------
        // operator-surat tabel disposisi surat masuk 
        Route::get('disposisi-surat', [SuratMasukController::class,'data_disposisi'])->name('disposisi_surat_masuk.index');
        // operator-surat ignore disposisi surat masuk 
        Route::get('disposisi-surat-ignore/{id}', [SuratMasukController::class,'ignore_disposisi'])->name('disposisi-surat-masuk.ignore');
        // operator-surat tabel disposisi surat masuk 
        Route::get('disposisi-surat-serverside', [SuratMasukController::class,'disposisi_masuk_serverside'])->name('disposisi_surat_masuk.serverside');
        // operator-surat teruskan disposisi surat masuk 
        Route::get('teruskan-disposisi-surat-masuk/{id}',[SuratMasukController::class,'teruskan_disposisi'])->name('disposisi-surat-masuk.teruskan');
        // operator-surat form disposisi surat masuk 
        Route::get('disposisi-surat-masuk/{id}',[SuratMasukController::class,'disposisi'])->name('disposisi-surat-masuk.create');
        // operator-surat store disposisi surat masuk
        Route::post('disposisi-surat-masuk',[SuratMasukController::class,'disposisi_store'])->name('disposisi-surat-masuk.store');
        // operator-surat store teruskan disposisi surat masuk 
        Route::post('teruskan-disposisi-surat-masuk',[SuratMasukController::class,'teruskan_disposisi_store'])->name('disposisi-surat-masuk-teruskan.store');
    // ---------------------------------Arsip Surat-------------------------------------------------
    
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
        //operator-kepegawaian: table data pegawai
        Route::get('cetak-pegawai-per-orangan/{data_pegawai}', [OperatorKepegawaianController::class,'cetak_perorangan'])->name('data-pegawai.cetakperorangan');
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

                    //kepegawaian
        // -----------------------penghargaan---------------------------------
        Route::resource('pegawai-penghargaan',PenghargaanController::class);
        // -----------------------pengalaman keluar negeri---------------------------------
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
         // -----------------------riwayat KGB---------------------------------
         Route::resource('pegawai-riwayat-kgb',RiwayatKGBController::class);
         // -----------------------dokumen pegawai---------------------------------
         Route::resource('dokumen-pegawai',DokumenPegawaiController::class);
        
    });



