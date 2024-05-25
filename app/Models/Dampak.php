<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dampak extends Model
{
    use HasFactory;

    protected $table = 'dampak';
    protected $primaryKey = 'id_dampak';
    protected $fillable = [
        'fk_id_kejadian_bencana',
        'fk_id_korban_terdampak',
        'fk2_id_kerusakan_rumah',
        'fk3_id_kerusakan_fasil_sosial',
        'fk4_id_kerusakan_infrastruktur',
        'fk5_id_pengungsian',
    ];

    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'fk_id_kejadian_bencana');
    }

    public function korbanTerdampak()
    {
        return $this->belongsTo(KorbanTerdampak::class, 'fk_id_korban_terdampak');
    }

    public function kerusakanRumah()
    {
        return $this->belongsTo(KerusakanRumah::class, 'fk2_id_kerusakan_rumah');
    }

    public function kerusakanFasilSosial()
    {
        return $this->belongsTo(KerusakanFasilSosial::class, 'fk3_id_kerusakan_fasil_sosial');
    }

    public function kerusakanInfrastruktur()
    {
        return $this->belongsTo(KerusakanInfrastruktur::class, 'fk4_id_kerusakan_infrastruktur');
    }

    public function pengungsian()
    {
        return $this->belongsTo(Pengungsian::class, 'fk5_id_pengungsian');
    }
}
