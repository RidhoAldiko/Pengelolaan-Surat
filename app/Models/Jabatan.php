<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    public $timestamps = false;
    protected $primaryKey = 'id_jabatan';
    protected $fillable = [
        'nama_jabatan','status'
    ];
    //tabel Jabatan terhubung dengan tabel pegawai dengan relasi one to one
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class,'id_jabatan','id_jabatan');
    }
}
