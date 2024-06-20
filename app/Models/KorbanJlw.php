<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorbanJlw extends Model
{
    use HasFactory;

    protected $table = 'korban_jlw';
    protected $primaryKey = 'id_korban_jlw';


    protected $fillable = [
        'luka_berat',
        'luka_ringan',
        'meninggal',
        'hilang',
        'mengungsi',
    ];
}
