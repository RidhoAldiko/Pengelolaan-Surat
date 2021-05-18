<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table = 'golongan';
    public $timestamps = false;
    protected $primaryKey = 'id_golongan';
    protected $fillable = [
        'pangkat','nama_golongan','status'
    ];
    //tabel golongan terhubung dengan tabel pegawai dengan relasi one to one
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class,'id_golongan','id_golongan');
    }

    //tabel golongan terhubung dengan tabel pegawai dengan relasi one to one
    public function riwayat_pangkat()
    {
        return $this->hasOne(RiwayatPangkat::class,'id_golongan','id_golongan');
    }
}
