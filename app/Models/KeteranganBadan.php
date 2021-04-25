<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class KeteranganBadan extends Model
{
    use HasFactory;
    protected $table = 'keterangan_badan';
    public $timestamps = false;
    protected $primaryKey ='id_ketbadan';

    protected $fillable =[
        'nip_pegawai',
        'tinggi',
        'berat_badan',
        'rambut',
        'bentuk_muka',
        'warna_kulit',
        'ciri_khas',
        'cacat_tubuh'
    ];
    public function pegawai(){
		return $this->belongsTo(Pegawai::class, 'nip_pegawai', 'id_hobi');
	}
 }
