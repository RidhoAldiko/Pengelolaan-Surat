<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengalamanKeluarNegeri extends Model
{
    use HasFactory;
    protected $table = 'pengalaman_keluar_negeri';
    public $timestamps = false;
    protected $primaryKey = 'id_keluarnegri';

    protected $fillable = [
        'nip_pegawai',
        'negara',
        'tujuan',
        'lama',
        'membiayai'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'nip_pegawai','id_keluarnegri');
    }
}
