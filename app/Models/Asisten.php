<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asisten extends Model
{
    use HasFactory;
    protected $table = 'asisten';
    public $timestamps = false;
    protected $primaryKey = 'id_asisten';
    protected $fillable = [
        'nama_asisten',
        'status',
    ];
}
