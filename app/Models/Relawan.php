<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;

    protected $table = 'relawan';
    protected $primaryKey = 'id_relawan';
    protected $fillable = [
        'id_user',
        'lokasi_relawan',
        'status_relawan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
