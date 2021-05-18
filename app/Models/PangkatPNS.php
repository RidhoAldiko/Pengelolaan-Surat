<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PangkatPNS extends Model
{
    use HasFactory;
    protected $table = 'pangkat_pns';
    public $timestamps = false;
    protected $primaryKey = 'id_pangkat_pns';
    protected $fillable = [
            'nip_pegawai',
            'id_golongan',
            'tmt',
            'penjabat',
            'nomor',
            'tanggal',
    ];
    
    public function pegawai(){
		return $this->belongsTo(Pegawai::class, 'nip_pegawai', 'id_pangkat_cpns');
	}
    //table pangkat memiliki 1 relasi yang dikirim ke tabel golongan dengan relasi one to one
    public function golongan()
    {
        return $this->belongsTo(Golongan::class,'id_golongan','id_golongan');
    }
}
