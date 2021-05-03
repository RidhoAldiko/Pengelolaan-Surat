<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPegawai extends Model
{
    use HasFactory;
    protected $table = 'dokumen_pegawai';
    public $timestamps = false;
    protected $primaryKey = 'id_dokpegawai';

    protected $fillable = [
        'nip_pegawai',
        'nama_dokumen',
        'keterangan',
        'file_dokumen'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_dokpegawai');
    }
}
