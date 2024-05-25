<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilisasiSd extends Model
{
    use HasFactory;

    protected $table = 'mobilisasi_sd';
    protected $primaryKey = 'id_mobilisasi_sd';
    protected $fillable = [
        'fk_id_personil',
        'fk2_id_tsr',
        'fk3_id_alat_tdb',
    ];

    public function personil()
    {
        return $this->belongsTo(Personil::class, 'fk_id_personil');
    }

    public function tsr()
    {
        return $this->belongsTo(Tsr::class, 'fk2_id_tsr');
    }

    public function alatTdb()
    {
        return $this->belongsTo(AlatTdb::class, 'fk3_id_alat_tdb');
    }
}
