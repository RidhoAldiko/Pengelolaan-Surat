<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Unit_kerja;
use App\Models\Golongan;
use App\Models\Jabatan;

class Pegawai extends Model
{
    // inisialisasi table yang digunakan
    protected $table='pegawai';
    // data yang bisa diinput oleh mahasiswa
    protected $fillable=[
        'nip_pegawai','nama_pegawai','jenis_kelamin','alamat','id_unit','id_golongan','id_jabatan','foto','status'
    ];
    //pk dari tabel pegawai
    protected $primaryKey = 'nip_pegawai';
    // disable fungsi increment dari table dosen
    public $incrementing = false;
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

}
