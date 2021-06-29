<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\DisposisiSuratMasuk as DisposisiMasuk;

class TeruskanDisposisiMasuk extends Model
{
    use HasFactory;
    protected $table = 'teruskan_disposisi_masuk';
    protected $primaryKey = 'id_teruskan_surat_masuk';
    protected $fillable = [
        'id',
        'id_disposisi_surat_masuk',
        'instruksi',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','id');
    }

    public function disposisi_masuk()
    {
        return $this->hasMany(DisposisiMasuk::class,'id_disposisi_surat_masuk','id_disposisi_surat_masuk');
    }
}
