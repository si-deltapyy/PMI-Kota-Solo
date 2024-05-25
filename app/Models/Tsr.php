<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tsr extends Model
{
    use HasFactory;

    protected $table = 'tsr';
    protected $primaryKey = 'id_tsr';
    protected $fillable = [
        'randu',
        'baramode',
        'reloif',
        'logistik',
        'watsan',
        'shelter',
        'showering',
    ];
}
