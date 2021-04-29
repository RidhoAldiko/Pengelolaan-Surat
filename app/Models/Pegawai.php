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
        'id_unit',
        'id_golongan',
        'id_jabatan',
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
    //table pegawai memiliki 1 relasi yang dikirim ke tabel unit_kerja dengan relasi one to one
    public function unit_kerja()
    {
        return $this->belongsTo(Unit_kerja::class,'id_unit','id_unit');
    }
    //table pegawai memiliki 1 relasi yang dikirim ke tabel golongan dengan relasi one to one
    public function golongan()
    {
        return $this->belongsTo(Golongan::class,'id_golongan','id_golongan');
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
    //table pegawai memiliki banyak alamat yang dikirim ketabel alamat dengan relasi one to many
    public function alamat()
    {
        return $this->hasMany(Alamat::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki 1 relasi yang dikirim ke tabel user dengan relasi one to one
    public function keterangan_badan()
    {
        return $this->hasOne(KeteranganBadan::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak alamat yang dikirim ketabel alamat dengan relasi one to many
    public function riwayat_pendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak keterangan keluarga yang dikirim ketabel alamat dengan relasi one to many
    public function keterangan_keluarga()
    {
        return $this->hasMany(KeteranganKeluarga::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak orang tua kandung yang dikirim ketabel alamat dengan relasi one to many
    public function orangtua_kandung()
    {
        return $this->hasMany(OrangtuaKandung::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak mertua yang dikirim ketabel alamat dengan relasi one to many
    public function mertua()
    {
        return $this->hasMany(Mertua::class,'nip_pegawai','nip_pegawai');
    }
    //table pegawai memiliki banyak saudara kandung yang dikirim ketabel alamat dengan relasi one to many
    public function saudara_kandung()
    {
        return $this->hasMany(SaudaraKandung::class,'nip_pegawai','nip_pegawai');
    }

}
