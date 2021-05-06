<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganLain extends Model
{
    use HasFactory;
    protected $table = 'keterangan_lain';
    public $timestamps = false;
    protected $primaryKey = 'id_ketlain';

    protected $fillable = [
        'nip_pegawai',
        'jenis',
        'penjabat',
        'nomor',
        'tanggal'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_ketlain');
    }
}
