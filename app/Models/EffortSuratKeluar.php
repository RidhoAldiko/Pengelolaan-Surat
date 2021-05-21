<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EffortSuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'effort_surat_keluar';
    protected $primaryKey = 'id_effort_surat';
    protected $fillable = [
        'id_surat_keluar',
        'indeks',
        'tanggal_effort',
    ];
}
