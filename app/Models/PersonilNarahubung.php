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
        'kontak',
        'id_kejadian'
    ];

    public function kejadianBencana()
    {
        return $this->hasMany(KejadianBencana::class, 'id_narahubung');
    }

    public function kejadianBencana()
    {
        return $this->belongsTo(KejadianBencana::class, 'id_kejadian');
    }

}
