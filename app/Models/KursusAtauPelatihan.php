<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KursusAtauPelatihan extends Model
{
    use HasFactory;
    protected $table = 'kursusataupelatihan';
    public $timestamps = false;
    protected $primaryKey = 'id_kursus';

    protected $fillable = [
        'nip_pegawai',
        'nama_kursus',
        'mulai',
        'selesai',
        'tanda_lulus',
        'tempat',
        'keterangan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_kursus');
    }
}
