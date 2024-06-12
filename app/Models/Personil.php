<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
    use HasFactory;

    protected $table = 'personil';

    protected $primaryKey = 'id_personil';

    protected $fillable = [
        'pengurus',
        'staf_markas_kabkota',
        'staf_markas_prov',
        'staf_markas_pusat',
        'relawan_pmi_kabkota',
        'relawan_pmi_prov',
        'relawan_pmi_linprov',
        'sukarelawan_sip',
    ];
}
