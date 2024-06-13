<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';

    protected $primaryKey = 'id_report';

    protected $fillable = [
        'id_user',
        'id_jeniskejadian',
        'tanggal_kejadian',
        'keterangan',
        'timestamp_report',
        'status',
        'lokasi_longitude',
        'lokasi_latitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenisKejadian()
    {
        return $this->belongsTo(JenisKejadian::class, 'id_jeniskejadian', 'id_jeniskejadian');
    }
}
