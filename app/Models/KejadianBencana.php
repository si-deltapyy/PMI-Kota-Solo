<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    use HasFactory;

    protected $table = 'kejadian_bencana';
    protected $primaryKey = 'id_kejadian';
    protected $fillable = [
        'tanggal_kejadian',
        'lokasi',
        'uraian',
        'kebutuhan_internasional',
        'keterangan',
        'akses_ke_lokasi',
        'kebutuhan',
        'giat_pemerintah',
        'hambatan',
    ];
}
