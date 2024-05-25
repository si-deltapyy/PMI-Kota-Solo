<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessment';
    protected $primaryKey = 'id_assessment';
    protected $fillable = [
        'id_relawan',
        'fk2_id_report',
        'timestamp_verifikasi',
        'hasil_verifikasi',
    ];

    public function relawan()
    {
        return $this->belongsTo(Relawan::class, 'id_relawan');
    }

    public function report()
    {
        return $this->belongsTo(Report::class, 'fk2_id_report');
    }
}
