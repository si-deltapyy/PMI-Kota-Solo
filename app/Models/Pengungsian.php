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
        'laki_laki',
        'perempuan',
        'kurang_dari_5',
        'atr_5_sampai_18',
        'lebih_dari_18',
        'jumlah',
        'kk',
        'jiwa',
    ];
}
