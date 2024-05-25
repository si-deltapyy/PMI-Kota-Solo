<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananKorban extends Model
{
    use HasFactory;

    protected $table = 'layanan_korban';
    protected $primaryKey = 'id_layanankankorban';
    protected $fillable = [
        'fk_id_assessment',
        'distribusi',
        'dapur_umum',
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class, 'fk_id_assessment');
    }
}
