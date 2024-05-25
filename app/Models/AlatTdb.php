<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatTdb extends Model
{
    use HasFactory;

    protected $table = 'alat_tdb';
    protected $primaryKey = 'id_alat_tdb';
    protected $fillable = [
        'randu_ops',
        'ruk_depot',
        'ruk_tanki',
        'double_cabin',
        'alat_du',
        'amk_tpm',
        'alat_wasan',
        'rs_lapangan',
        'alat_pkod',
        'gedung_lapangan',
        'produk_giz',
        'alat_il_lapangan',
    ];
}
