<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    // Nama tabel untuk model
    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    protected $fillable = [
        'id_user',
        'nama_bencana',
        'tanggal_kejadian',
        'keterangan',
        'timestamp_report',
        'status',
        'lokasi_longitude',
        'lokasi_latitude'
    ];
}
