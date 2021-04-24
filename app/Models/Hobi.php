<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Hobi extends Model
{
    use HasFactory;

    protected $table='hobi';
    protected $fillable=[
        'hobi',
        'nip_pegawai'
    ];
    protected $primaryKey='id_hobi';
    public $timestamps = false;
    
    public function pegawai(){
		return $this->belongsTo(Pegawai::class, 'nip_pegawai', 'id_hobi');
	}
}
