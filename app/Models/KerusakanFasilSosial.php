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
        'kerusakan_fasil_sosial',
        'keloalah',
        'tempat_ibadah',
        'rumah_sakit',
        'senar',
        'gedung_pemerintah',
        'lari_lain',
    ];
}
