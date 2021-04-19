<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit_kerja extends Model
{
    use HasFactory;
    protected $table = 'unit_kerja';
    public $timestamps = false;
    protected $primaryKey = 'id_unit';
    protected $fillable = [
        'nama_unit','status'
    ];
    //tabel Jabatan terhubung dengan tabel unit_kerja dengan relasi one to one
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class,'id_unit','id_unit');
    }
}
