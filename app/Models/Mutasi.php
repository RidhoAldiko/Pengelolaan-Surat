<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    use HasFactory;
    protected $table = 'mutasi';
    public $timestamps = false;
    protected $primaryKey = 'id_mutasi';

    protected $fillable = [
        'nip_pegawai',
        'jenis_mutasi',
        'asal',
        'tujuan',
        'tanggal'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','nip_pegawai');
    }
    
}
