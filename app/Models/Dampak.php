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
        'id_korban_terdampak',        
        'id_korban_jlw',
        'id_kerusakan_rumah',
        'id_kerusakan_fasil_sosial',
        'id_kerusakan_infrastruktur',
        'id_pengungsian',
        'id_kejadian',
    ];

    public function korbanTerdampak()
    {
        return $this->belongsTo(KorbanTerdampak::class, 'id_korban_terdampak');
    }

    public function korbanJlw()
    {
        return $this->belongsTo(KorbanJlw::class, 'id_korban_jlw');
    }

    public function kerusakanRumah()
    {
        return $this->belongsTo(KerusakanRumah::class, 'id_kerusakan_rumah');
    }

    public function kerusakanFasilitasSosial()
    {
        return $this->belongsTo(KerusakanFasilSosial::class, 'id_kerusakan_fasil_sosial');
    }

    public function kerusakanInfrastruktur()
    {
        return $this->belongsTo(KerusakanInfrastruktur::class, 'id_kerusakan_infrastruktur');
    }

    public function pengungsian()
    {
        return $this->belongsTo(Pengungsian::class, 'id_pengungsian');
    }

    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'id_kejadian');
    }
}
