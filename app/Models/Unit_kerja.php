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
}
