<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBagian extends Model
{
    use HasFactory;
    protected $table = 'sub_bagian';
    public $timestamps = false;
    protected $primaryKey = 'id_sub_bagian';
    protected $fillable = [
        'id_bagian',
        'nama_sub_bagian',
        'status',
    ];
    public function bagian()
    {
        return $this->hasMany(Bagian::class,'id_bagian','id_bagian');
    }
}
