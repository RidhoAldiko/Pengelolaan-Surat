<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    use HasFactory;

    protected $table        = 'riwayat_pendidikan';
    public $timestamps      = false;
    protected $primaryKey   = 'id_riwayatpendidikan';
    protected $fillable     = [
        'nip_pegawai',
        'jenis_pendidikan',
        'nama_pendidikan',
        'jurusan',
        'no_sttb',
        'tgl_sttb',
        'tempat',
        'nama_kepsek',
        'mulai',
        'sampai',
        'tanda_lulus'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'nip_pegawai','id_riwayatpendidikan');
    }

}
