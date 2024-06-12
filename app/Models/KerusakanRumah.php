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
        'luka_berat',
        'luka_ringan',
        'hilang',
        'mengungsi',
    ];
}
