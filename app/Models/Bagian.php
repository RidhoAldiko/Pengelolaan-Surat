<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bagian extends Model
{
    use HasFactory;
    protected $table = 'bagian';
    public $timestamps = false;
    protected $primaryKey = 'id_bagian';
    protected $fillable = [
        'id_asisten',
        'nama_bagian',
        'status',
    ];
    public function asisten()
    {
        return $this->hasMany(Asisten::class,'id_asisten','id_asisten');
    }
}
