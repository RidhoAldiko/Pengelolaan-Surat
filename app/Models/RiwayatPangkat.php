<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    use HasFactory;

    protected $table        = 'riwayat_pangkat';
    public $timestamps      = false;
    protected $primaryKey   = 'id_riwayat_pangkat';
    protected $fillable     = [
        'nip_pegawai',
        'id_golongan',
        'tmt',
        'penjabat',
        'nomor',
        'tanggal'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pegawai','id_riwayat_pangkat');
    }

    //table pangkat memiliki 1 relasi yang dikirim ke tabel golongan dengan relasi one to one
    public function golongan()
    {
        return $this->belongsTo(Golongan::class,'id_golongan','id_golongan');
    }
}
