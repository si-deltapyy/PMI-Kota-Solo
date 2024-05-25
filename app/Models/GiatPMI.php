<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiatPMI extends Model
{
    use HasFactory;

    protected $table = 'giat_pmi';
    protected $primaryKey = 'id_giatpmi';
    protected $fillable = [
        'fk_id_evakuasikankorban',
        'fk2_id_layanankankorban',
        'rombong',
    ];

    public function evakuasiKorban()
    {
        return $this->belongsTo(EvakuasiKorban::class, 'fk_id_evakuasikankorban');
    }

    public function layananKorban()
    {
        return $this->belongsTo(LayananKorban::class, 'fk2_id_layanankankorban');
    }
}
