<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
    use HasFactory;
    protected $table = 'penghargaan';
    public $timestamps = false;
    protected $primaryKey = 'id_penghargaan';

    protected $fillable = [
        'nip_pegawai',
        'nama_penghargaan',
        'tahun',
        'negara_instansi'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_penghargaan');
    }
}
