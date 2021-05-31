<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Unit_kerja;
use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Hobi;
use App\Models\Alamat;
use App\Models\KeteranganBadan;
use App\Models\RiwayatPendidikan;
use App\Models\KeteranganKeluarga;
use App\Models\OrangtuaKandung;
use App\Models\Mertua;
use App\Models\SaudaraKandung;
use App\Models\Penghargaan;

class Pegawai extends Model
{
    // inisialisasi table yang digunakan
    protected $table='pegawai';
    // data yang bisa diinput oleh mahasiswa
    protected $fillable=[
        'nip_pegawai',
        'nama_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'status_perkawinan',
        'nomor_karpeg',
        'id_jabatan',
        'id_unit',
        'foto',
        'status'
    ];
    //pk dari tabel pegawai
    protected $primaryKey = 'nip_pegawai';
    // tentukan tipe data dari primary
    protected $keyType ='string';

    //table pegawai memiliki 1 relasi yang dikirim ke tabel user dengan relasi one to one
    public function user()
    {
        return $this->hasOne(User::class,'id','nip_pegawai');
    }
    //table pegawai memiliki 1 relasi yang dikirim ke tabel jabatan dengan relasi one to one
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class,'id_jabatan','id_jabatan');
    }
    //table pegawai memiliki banyak hobi yang dikirim ketabel hobi dengan relasi one to many
    public function hobi()
    {
        return $this->hasMany(Hobi::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki 1 relasi yang dikirim ketabel alamat dengan relasi one to one
    public function alamat()
    {
        return $this->hasOne(Alamat::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki 1 relasi yang dikirim ke tabel keterangan badan dengan relasi one to one
    public function keterangan_badan()
    {
        return $this->hasOne(KeteranganBadan::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak alamat yang dikirim ketabel riwayat pendidikan dengan relasi one to many
    public function riwayat_pendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak keterangan keluarga yang dikirim ketabel ketabel keluarga dengan relasi one to many
    public function keterangan_keluarga()
    {
        return $this->hasMany(KeteranganKeluarga::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak orang tua kandung yang dikirim ketabel orang tua kandung dengan relasi one to many
    public function orangtua_kandung()
    {
        return $this->hasMany(OrangtuaKandung::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak mertua yang dikirim ketabel mertua dengan relasi one to many
    public function mertua()
    {
        return $this->hasMany(Mertua::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak saudara kandung yang dikirim ketabel saudara kandung dengan relasi one to many
    public function saudara_kandung()
    {
        return $this->hasMany(SaudaraKandung::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak penghargaan yang dikirim ketabel penghargaan dengan relasi one to many
    public function penghargaan()
    {
        return $this->hasMany(Penghargaan::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak pengalaman keluar negeri yang dikirim ketabel pengalaman keluar negeri dengan relasi one to many
    public function pengalaman_keluar_negeri()
    {
        return $this->hasMany(PengalamanKeluarNegeri::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak organisasi yang dikirim ketabel organisasi dengan relasi one to many
    public function organisasi()
    {
        return $this->hasMany(Organisasi::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak keterangan lain yang dikirim ketabel keterangan lain dengan relasi one to many
    public function keterangan_lain()
    {
        return $this->hasMany(KeteranganLain::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak mutasi yang dikirim ketabel mutasi dengan relasi one to many
    public function mutasi()
    {
        return $this->hasMany(Mutasi::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak diklat_penjenjangan yang dikirim ketabel diklat_penjenjangan dengan relasi one to many
    public function diklat_penjenjangan()
    {
        return $this->hasMany(DiklatPenjenjangan::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak dokumen pegawai yang dikirim ketabel dokumen pegawai dengan relasi one to many
    public function dokumen_pegawai()
    {
        return $this->hasMany(DokumenPegawai::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak riwayat pangkat pegawai yang dikirim ketabel riwayat pangkat pegawai dengan relasi one to many
    public function riwayat_pangkat()
    {
        return $this->hasMany(RiwayatPangkat::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak riwayat kgb pegawai yang dikirim ketabel riwayat kgb pegawai dengan relasi one to many
    public function riwayat_kgb()
    {
        return $this->hasMany(RiwayatKGB::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki 1 relasi yang dikirim ketabel pangkat_cpns dengan relasi one to one
    public function pangkat_cpns()
    {
        return $this->hasOne(PangkatCPNS::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki 1 relasi yang dikirim ketabel pangkat_cpns dengan relasi one to one
    public function pangkat_pns()
    {
        return $this->hasOne(PangkatPNS::class,'nip_pegawai','nip_pegawai');
    }

}
