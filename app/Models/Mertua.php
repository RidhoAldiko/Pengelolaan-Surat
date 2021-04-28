<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mertua extends Model
{
    use HasFactory;
    protected $table = 'mertua';
    public $timestamps = false;
    protected $primaryKey = 'id_mertua';

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
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_mertua');
    }
}
