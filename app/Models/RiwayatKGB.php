<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatKGB extends Model
{
    use HasFactory;
    protected $table        = 'riwayat_kgb';
    public $timestamps      = false;
    protected $primaryKey   = 'id_riwayat_kgb';
    protected $fillable     = [
        'nip_pegawai',
        'mulai_berlaku',
        'batas_berlaku',
        'id_gaji',
        'status'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pegawai','nip_pegawai');
    }

    //tabel Jabatan terhubung dengan tabel gaji dengan relasi one to one
    public function gaji()
    {
        return $this->hasOne(Gaji::class,'id_gaji','id_gaji');
    }
}
