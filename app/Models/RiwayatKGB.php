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
        'id_golongan',
        'penjabat',
        'nomor',
        'tanggal',
        'jumlah_gaji',
        'mkg',
        'mulai_berlaku',
        'batas_berlaku',
        'peraturan',
        'status'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pegawai','nip_pegawai');
    }

    //table pangkat memiliki 1 relasi yang dikirim ke tabel golongan dengan relasi one to one
    public function golongan()
    {
        return $this->belongsTo(Golongan::class,'id_golongan','id_golongan');
    }
}
