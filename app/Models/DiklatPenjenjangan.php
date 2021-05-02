<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiklatPenjenjangan extends Model
{
    use HasFactory;
    protected $table = 'diklat_penjenjangan';
    public $timestamps = false;
    protected $primaryKey = 'id_diklat';

    protected $fillable = [
        'nip_pegawai',
        'nama_diklat',
        'tahun',
        'nomor',
        'tanggal',
        'bukti_lulus'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_diklat');
    }
}
