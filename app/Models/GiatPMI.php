<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiatPmi extends Model
{
    use HasFactory;

    protected $table = 'giat_pmi';
    protected $primaryKey = 'id_giatpmi';
    public $timestamps = true;

    protected $fillable = [
        'id_evakuasikorban',
        'id_layanankorban'
    ];

    public function evakuasiKorban()
    {
        return $this->belongsTo(EvakuasiKorban::class, 'id_evakuasikorban');
    }

    public function layananKorban()
    {
        return $this->belongsTo(LayananKorban::class, 'id_layanankorban');
    }

    public function kejadianBencana()
    {
        return $this->hasMany(KejadianBencana::class, 'id_giat_pmi');
    }
}
