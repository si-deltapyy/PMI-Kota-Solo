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
        'kend_ops',
        'truk_angkut',
        'truk_tanki',
        'double_cabin',
        'alat_du',
        'ambulans',
        'alat_watsan',
        'rs_lapangan',
        'alat_pkdd',
        'gudang_lapangan',
        'posko_aju',
        'alat_it_lapangan',
    ];
}
