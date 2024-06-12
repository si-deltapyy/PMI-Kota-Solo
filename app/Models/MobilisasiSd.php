<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilisasiSd extends Model
{
    use HasFactory;

    protected $table = 'mobilisasi_sd';
    protected $primaryKey = 'id_mobilisasi_sd';
    public $timestamps = true;

    protected $fillable = [
        'id_personil',
        'id_tsr',
        'id_alat_tdb'
    ];

    public function personil()
    {
        return $this->belongsTo(Personil::class, 'id_personil');
    }

    public function tsr()
    {
        return $this->belongsTo(Tsr::class, 'id_tsr');
    }

    public function alatTdb()
    {
        return $this->belongsTo(AlatTdb::class, 'id_alat_tdb');
    }

    public function kejadianBencana()
    {
        return $this->hasMany(KejadianBencana::class, 'id_mobilisasi_sd');
    }
}
