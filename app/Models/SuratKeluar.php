<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;
    protected $table = 'surat_keluar';
    protected $primaryKey = 'id_surat_keluar';
    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'perihal',
        'isi_ringkasan',
        'hubungan_nomor_surat',
        'alamat',
        'keterangan',
        'file_surat',
        'status',
    ];

    public function disposisi_surat_keluar()
    {
        return $this->hasMany(DisposisiSuratKeluar::class,'id_surat_keluar','id_surat_keluar');
    }
}
