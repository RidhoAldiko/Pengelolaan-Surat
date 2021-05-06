<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DisposisiSuratMasuk;

class SuratMasuk extends Model
{
    use HasFactory;
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat_masuk';
    protected $fillable = [
        'pengirim',
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'isi_ringkasan',
        'hubungan_nomor_surat',
        'file_surat',
        'status',
    ];

    public function disposisi_surat_masuk()
    {
        return $this->hasMany(DisposisiSuratMasuk::class,'id_surat_masuk','id_surat_masuk');
    }
}
