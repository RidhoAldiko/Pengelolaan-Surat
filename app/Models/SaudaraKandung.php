<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaudaraKandung extends Model
{
    use HasFactory;
    protected $table = 'saudara_kandung';
    public $timestamps = false;
    protected $primaryKey = 'id_saudarakandung';

    protected $fillable = [
        'nip_pegawai',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'pekerjaan',
        'keterangan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_saudarakandung');
    }
}
