<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    public $timestamps = true;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'id_report');
    }
}
