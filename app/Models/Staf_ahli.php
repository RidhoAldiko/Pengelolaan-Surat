<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staf_ahli extends Model
{
    use HasFactory;
    protected $table = 'staf_ahli';
    public $timestamps = false;
    protected $primaryKey = 'id_staf_ahli';
    protected $fillable = [
        'nama_staf_ahli',
        'status',
    ];
}
