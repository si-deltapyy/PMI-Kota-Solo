<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerusakanFasilSosial extends Model
{
    use HasFactory;

    protected $table = 'kerusakan_fasil_sosial';

    protected $primaryKey = 'id_kerusakan_fasil_sosial';

    protected $fillable = [
        'sekolah',
        'tempat_ibadah',
        'rumah_sakit',
        'pasar',
        'gedung_pemerintah',
        'lain_lain',
    ];
}
