<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvakuasiKorban extends Model
{
    use HasFactory;

    protected $table = 'evakuasi_korban';
    protected $primaryKey = 'id_evakuasikankorban';
    protected $fillable = [
        'laka_yangdinevakuasi',
        'laka_ringanberat',
        'meninggal',
    ];
}
