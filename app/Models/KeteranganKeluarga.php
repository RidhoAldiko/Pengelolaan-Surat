<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeteranganKeluarga extends Model
{
    use HasFactory;
    protected $table = 'keterangan_keluarga';
    public $timestamps = false;
    protected $primaryKey = 'id_ketKeluarga';

    protected $fillable = [
        'nip_pegawai',
        'status',
        'nama',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'tgl_nikah',
        'pekerjaan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_ketKeluarga');
    }
}
