<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory;
    protected $table = 'golongan';
    public $timestamps = false;
    protected $primaryKey = 'id_golongan';
    protected $fillable = [
        'nama_golongan','status'
    ];
    //tabel Jabatan terhubung dengan tabel golongan dengan relasi one to one
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class,'id_golongan','id_golongan');
    }
}