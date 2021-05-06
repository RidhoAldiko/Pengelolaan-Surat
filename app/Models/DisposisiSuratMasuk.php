<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DisposisiSuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'disposisi_surat_masuk';
    protected $primaryKey = 'id_disposisi_surat_masuk';
    protected $fillable = [
        'id_surat_masuk',
        'indeks',
        'tanggal_disposisi',
        'status',
    ];

    
}
