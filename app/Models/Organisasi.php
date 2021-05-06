<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;
    protected $table = 'organisasi';
    public $timestamps = false;
    protected $primaryKey = 'id_organisasi';

    protected $fillable = [
        'nip_pegawai',
        'waktu',
        'nama',
        'kedudukan',
        'tahun_mulai',
        'tahun_selesai',
        'tempat',
        'pimpinan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_organisasi');
    }
}
