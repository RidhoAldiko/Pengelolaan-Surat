<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $primaryKey='id_notif';
    protected $table='notifikasi';
    protected $fillable=[
        'judul',
        'pesan',
        'id_user',
        'status',
    ];
}
