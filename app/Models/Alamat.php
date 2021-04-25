<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Alamat extends Model
{
    use HasFactory;
    protected $table = 'alamat';
    public $timestamps = false;
    protected $primaryKey ='id_alamat';

    protected $fillable =[
        'nip_pegawai',
        'jalan',
        'kelurahan_desa',
        'kecamatan',
        'kabupaten_kota',
        'provinsi'
    ];

    public function pegawai(){
		return $this->belongsTo(Pegawai::class, 'nip_pegawai', 'id_hobi');
	}
}
