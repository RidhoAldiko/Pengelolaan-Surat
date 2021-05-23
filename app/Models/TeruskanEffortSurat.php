<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EffortSuratKeluar;
use App\Models\User;

class TeruskanEffortSurat extends Model
{
    use HasFactory;
    protected $table = 'teruskan_effort_surat';
    protected $primaryKey = 'id_teruskan_effort_surat';
    protected $fillable = [
        'id',
        'id_effort_surat',
        'instruksi',
        'paraf',
        'status',
    ];

    public function user()
    {
        return $this->hasMany(User::class,'id','id');
    }

    public function disposisi_masuk()
    {
        return $this->hasMany(EffortSuratKeluar::class,'id_effort_surat','id_effort_surat');
    }
}
