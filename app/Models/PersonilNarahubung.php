<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonilNarahubung extends Model
{
    use HasFactory;

    protected $table = 'personil_narahubung';
    protected $primaryKey = 'id_narahubung';
    public $timestamps = true;

    protected $fillable = [
        'nama_lengkap',
        'posisi',
        'kontak'
    ];

    public function kejadianBencana()
    {
        return $this->hasMany(KejadianBencana::class, 'id_narahubung');
    }
}
