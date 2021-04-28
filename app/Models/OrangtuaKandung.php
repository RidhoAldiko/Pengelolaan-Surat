<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangtuaKandung extends Model
{
    use HasFactory;
    protected $table = 'orangtua_kandung';
    public $timestamps = false;
    protected $primaryKey = 'id_orangtua';

    protected $fillable = [
        'nip_pegawai',
        'status',
        'nama',
        'tgl_lahir',
        'pekerjaan',
        'keterangan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_orangtua');
    }
}
