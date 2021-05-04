<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = 'gaji';
    public $timestamps = false;
    protected $primaryKey = 'id_gaji';
    protected $fillable = [
        'id_golongan',
        'mkg',
        'jumlah_gaji',
        'status'
    ];

    //table pangkat memiliki 1 relasi yang dikirim ke tabel golongan dengan relasi one to one
    public function golongan()
    {
        return $this->belongsTo(Golongan::class,'id_golongan','id_golongan');
    }

    //table pegawai memiliki 1 relasi yang dikirim ke tabel unit_kerja dengan relasi one to one
    public function riwayat_kgb()
    {
        return $this->belongsTo(RiwayatKGB::class,'id_gaji','id_gaji');
    }
}
