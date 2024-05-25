<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KerusakanRumah extends Model
{
    use HasFactory;

    protected $table = 'kerusakan_rumah';
    protected $primaryKey = 'id_kerusakan_rumah';
    protected $fillable = [
        'fk2_id_kejadian_bencana',
        'fk3_id_kerusakan_fasil_sosial',
        'fk4_id_kerusakan_infrastruktur',
        'luka_berat',
        'luka_ringan',
        'hitung',
        'mengungsi',
    ];

    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'fk2_id_kejadian_bencana');
    }

    public function kerusakanFasilSosial()
    {
        return $this->belongsTo(KerusakanFasilSosial::class, 'fk3_id_kerusakan_fasil_sosial');
    }

    public function kerusakanInfrastruktur()
    {
        return $this->belongsTo(KerusakanInfrastruktur::class, 'fk4_id_kerusakan_infrastruktur');
    }
}
