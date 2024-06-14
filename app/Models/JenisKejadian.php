<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKejadian extends Model
{
    use HasFactory;

    protected $table = 'jenis_kejadian';
    protected $primaryKey = 'id_jeniskejadian';
    public $timestamps = true;

    protected $fillable = [
        'nama_kejadian'
    ];

    public function kejadianBencana()
    {
        return $this->hasMany(KejadianBencana::class, 'id_jeniskejadian');
    }
}
