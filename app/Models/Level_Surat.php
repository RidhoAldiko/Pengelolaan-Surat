<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Level_Surat extends Model
{
    use HasFactory;
    protected $table = 'level_surat';
    public $timestamps = false;
    protected $primaryKey = 'id_level_surat';
    protected $fillable = [
        'nama_level','urutan_level'
    ];
    //tabel level_surat terhubung dengan tabel golongan dengan relasi one to one
    public function pegawai()
    {
        return $this->hasOne(User::class,'id_level_surat','id_level_surat');
    }
}
