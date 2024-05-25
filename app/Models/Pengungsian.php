<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengungsian extends Model
{
    use HasFactory;

    protected $table = 'pengungsian';
    protected $primaryKey = 'id_pengungsian';
    protected $fillable = [
        'nama_lokasi',
        'lati_lati',
        'lonngi_itude',
        '<5',
        '>5_<=18',
        '>18',
        'jumlah',
    ];
}
