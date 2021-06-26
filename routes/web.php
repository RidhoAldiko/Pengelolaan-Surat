<?php

use Illuminate\Support\Facades\Route;
//Admin Controller
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\GajiController;
use App\Http\Controllers\Admin\GolonganController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\UnitKerjaController;
use App\Http\Controllers\Admin\LevelSuratController;
//Opertor Kepegawaian Controller
use App\Http\Controllers\OperatorKepegawaian\PenghargaanController;
use App\Http\Controllers\OperatorKepegawaian\AlamatController;
use App\Http\Controllers\OperatorKepegawaian\DiklatPenjenjanganController;
use App\Http\Controllers\OperatorKepegawaian\DokumenPegawaiController;
use App\Http\Controllers\OperatorKepegawaian\HobiController;
use App\Http\Controllers\OperatorKepegawaian\KeteranganBadanController;
use App\Http\Controllers\OperatorKepegawaian\KeteranganKeluargaController;
use App\Http\Controllers\OperatorKepegawaian\KeteranganLainController;
use App\Http\Controllers\OperatorKepegawaian\KursusAtauPelatihanController;
use App\Http\Controllers\OperatorKepegawaian\MertuaController;
use App\Http\Controllers\OperatorKepegawaian\MutasiController;
use App\Http\Controllers\OperatorKepegawaian\OperatorKepegawaianController;
use App\Http\Controllers\OperatorKepegawaian\OrangtuaKandungController;
use App\Http\Controllers\OperatorKepegawaian\OrganisasiController;
use App\Http\Controllers\OperatorKepegawaian\PangkatCPNSController;
use App\Http\Controllers\OperatorKepegawaian\PangkatPNSController;
use App\Http\Controllers\OperatorKepegawaian\PengalamanKeluarNegeriController;
use App\Http\Controllers\OperatorKepegawaian\PrintPegawaiController;
use App\Http\Controllers\OperatorKepegawaian\RiwayatKGBController;
use App\Http\Controllers\OperatorKepegawaian\RiwayatPangkatController;
use App\Http\Controllers\OperatorKepegawaian\RiwayatPendidikanController;
use App\Http\Controllers\OperatorKepegawaian\SaudaraKandungController;
//Operator Surat Controller
use App\Http\Controllers\OperatorSurat\OperatorSuratController;
use App\Http\Controllers\OperatorSurat\SuratMasukController;
use App\Http\Controllers\OperatorSurat\SuratKeluarController;
use App\Http\Controllers\OperatorSurat\DisposisiMasukController;
use App\Http\Controllers\OperatorSurat\ArsipSuratMasukController;
use App\Http\Controllers\OperatorSurat\EffortSuratController;
use App\Http\Controllers\UpdateProfileController;
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

Route::get('update-profile-pegawai', [UpdateProfileController::class,'form_edit_profile'])->name('edit_profil.form');
Route::patch('update-profile-pegawai', [UpdateProfileController::class,'update_profile'])->name('edit_profil.update');

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
        //----Pegawai----
            Route::get('admin-data-pegawai', [PegawaiController::class,'index'])->name('admin-pegawai.index');
            Route::get('admin-data-pegawai-serverside', [PegawaiController::class,'pegawai_serverSide'])->name('admin-pegawai.serverside');
            Route::get('admin-create-data-pegawai', [PegawaiController::class,'pegawai_create'])->name('admin-pegawai.create');
        //----Data Master----
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
        //operator-surat search pegawai
        Route::get('search-pengguna', [OperatorSuratController::class,'search_pengguna'])->name('operator-surat.search');
        //operator-surat dashboard
        Route::get('/', [OperatorSuratController::class,'index'])->name('operator-surat.index');

    //----Surat masuk----
        // operator-surat store surat masuk 
        Route::post('surat-masuk', [SuratMasukController::class,'store'])->name('surat-masuk.store');
        
        Route::get('surat-masuk/cetak_surat_masuk', [SuratMasukController::class,'cetak_laporan_surat_masuk'])->name('surat-masuk.cetak_laporan_surat_masuk');
        // operator-surat data surat masuk 
        Route::get('surat-masuk', [SuratMasukController::class,'index'])->name('surat-masuk.index');
        // operator-surat form surat masuk 
        Route::get('surat-masuk/create', [SuratMasukController::class,'create'])->name('surat-masuk.create');
        // operator-surat hapus surat masuk 
        Route::delete('surat-masuk/{data}', [SuratMasukController::class,'destroy'])->name('surat-masuk.destroy');
        // operator-surat update surat masuk 
        Route::put('surat-masuk/{id}',[SuratMasukController::class,'update'])->name('surat-masuk.update');
        // operator-surat detail surat masuk 
        Route::get('surat-masuk/{id}', [SuratMasukController::class,'show'])->name('surat-masuk.show');
        // operator-surat edit surat masuk 
        Route::get('surat-masuk/{id}/edit',[SuratMasukController::class,'edit'])->name('surat-masuk.edit');
        

    //----Disposisi Surat Masuk----
        // operator-surat store disposisi surat masuk
        Route::post('disposisi-surat-masuk',[DisposisiMasukController::class,'store'])->name('disposisi-surat-masuk.store');
        // operator-surat tabel disposisi surat masuk 
        Route::get('disposisi-surat-masuk', [DisposisiMasukController::class,'index'])->name('disposisi-surat-masuk.index');
        // operator-surat tabel disposisi surat masuk 
        Route::get('disposisi-surat-masuk/cetak_disposisi', [DisposisiMasukController::class,'cetak_disposisi'])->name('disposisi-surat-masuk.cetak');
        // operator-surat form disposisi surat masuk 
        Route::get('disposisi-surat-masuk/{id}/create',[DisposisiMasukController::class,'create'])->name('disposisi-surat-masuk.create');
        // operator-surat destroy disposisi surat masuk
        Route::delete('disposisi-surat-masuk/{data}',[DisposisiMasukController::class,'destroy'])->name('disposisi-surat-masuk.destroy');
        // operator-surat update disposisi surat masuk 
        Route::put('disposisi-surat-masuk/{id}',[DisposisiMasukController::class,'update'])->name('disposisi-surat-masuk.update');
        // operator-surat detail disposisi surat masuk 
        Route::get('disposisi-surat-masuk/{id}', [DisposisiMasukController::class,'show'])->name('disposisi-surat-masuk.show');
        // operator-surat edit disposisi surat masuk 
        Route::get('disposisi-surat-masuk/{id}/edit',[DisposisiMasukController::class,'edit'])->name('disposisi-surat-masuk.edit');
        // operator-surat ignore disposisi surat masuk 
        Route::get('disposisi-surat-masuk/{id}/ignore', [DisposisiMasukController::class,'ignore'])->name('disposisi-surat-masuk.ignore');
        // operator-surat teruskan disposisi surat masuk 
        Route::get('disposisi-surat-masuk/{id}/forward',[DisposisiMasukController::class,'forward'])->name('disposisi-surat-masuk.forward');
        // operator-surat store teruskan disposisi surat masuk 
        Route::post('disposisi-surat-masuk/forward/store',[DisposisiMasukController::class,'store_forward'])->name('disposisi-surat-masuk.store-forward');

    //----Arsip surat Masuk----
        // operator-surat arsip surat
        Route::get('arsip-surat-masuk', [ArsipSuratMasukController::class,'index'])->name('arsip-surat-masuk.index');
        // operator-surat serverside arsip surat
        Route::get('arsip-surat-masuk/server-side', [ArsipSuratMasukController::class,'arsip_surat_serverside'])->name('arsip-surat-masuk.serverside');

    //----Surat Keluar----
        // operator-surat store surat keluar 
        Route::post('surat-keluar', [SuratKeluarController::class,'store'])->name('surat-keluar.store');
        // operator-surat data surat keluar 
        Route::get('surat-keluar', [SuratKeluarController::class,'index'])->name('surat-keluar.index');
        // operator-surat form surat keluar 
        Route::get('surat-keluar/create', [SuratKeluarController::class,'create'])->name('surat-keluar.create');
        // operator-surat hapus surat keluar 
        Route::delete('surat-keluar/{data}', [SuratKeluarController::class,'destroy'])->name('surat-keluar.destroy');
        // operator-surat update surat keluar 
        Route::put('surat-keluar/{id}',[SuratKeluarController::class,'update'])->name('surat-keluar.update');
        // operator-surat detail surat keluar 
        Route::get('surat-keluar/{id}', [SuratKeluarController::class,'show'])->name('surat-keluar.show');
        // operator-surat edit surat keluar 
        Route::get('surat-keluar/{id}/edit',[SuratKeluarController::class,'edit'])->name('surat-keluar.edit');
        
    //----Effort Surat Keluar----
        // operator-surat store effort surat keluar 
        Route::post('effort-surat',[EffortSuratController::class,'store'])->name('effort-surat.store');
        // operator-surat data effort surat keluar 
        Route::get('effort-surat',[EffortSuratController::class,'index'])->name('effort-surat.index');
        // operator-surat create effort surat keluar 
        Route::get('effort-surat/{id}/create',[EffortSuratController::class,'create'])->name('effort-surat.create');
        // operator-surat hapus effort surat keluar 
        Route::delete('effort-surat/{data}', [EffortSuratController::class,'destroy'])->name('effort-surat.destroy');
        // operator-surat update effort surat keluar 
        Route::put('effort-surat/{id}', [EffortSuratController::class,'update'])->name('effort-surat.update');
        // operator-surat detail effort surat keluar 
        Route::get('effort-surat/{id}', [EffortSuratController::class,'show'])->name('effort-surat.show');
        // operator-surat edit effort surat keluar 
        Route::get('effort-surat/{id}/edit', [EffortSuratController::class,'edit'])->name('effort-surat.edit');
        // operator-surat detail effort surat keluar 
        Route::get('effort-surat/{id}/forward', [EffortSuratController::class,'forward'])->name('effort-surat.forward');
        // operator-surat detail effort surat keluar 
        Route::post('effort-surat/forward/store', [EffortSuratController::class,'store_forward'])->name('effort-surat.store-forward');
    
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
         // -----------------------pangkat cpns---------------------------------
         Route::resource('pegawai-pangkat-cpns',PangkatCPNSController::class);
          // -----------------------pangkat pns---------------------------------
          Route::resource('pegawai-pangkat-pns',PangkatPNSController::class);
         // -----------------------riwayat pangkat---------------------------------
         Route::resource('pegawai-riwayat-pangkat',RiwayatPangkatController::class);
         // -----------------------riwayat KGB---------------------------------
         Route::resource('pegawai-riwayat-kgb',RiwayatKGBController::class);
         // -----------------------dokumen pegawai---------------------------------
         Route::resource('dokumen-pegawai',DokumenPegawaiController::class);
         // -----------------------kursus atau pelatihan---------------------------------
         Route::resource('kursus-atau-pelatihan',KursusAtauPelatihanController::class);


          //operator-kepegawaian: print data perorangan
         Route::get('cetak-pegawai-per-orangan/{data_pegawai}', [PrintPegawaiController::class,'cetak_perorangan'])->name('print-pegawai.cetakperorangan');
         //operator-kepegawaian: print semua data pegawai
         Route::get('cetak-pegawai', [PrintPegawaiController::class,'cetakdata'])->name('print-pegawai.cetakdata');
    });



