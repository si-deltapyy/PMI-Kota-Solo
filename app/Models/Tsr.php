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
        'medis',
        'paramedis',
        'relief',
        'logistik',
        'watsan',
        'it_telekom',
        'sheltering',
    ];
}
