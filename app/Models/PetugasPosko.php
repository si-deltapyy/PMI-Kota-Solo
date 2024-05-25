<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetugasPosko extends Model
{
    use HasFactory;

    protected $table = 'petugas_posko';
    protected $primaryKey = 'id_petugas_posko';
    protected $fillable = [
        'nama_lengkap',
        'kontak',
    ];
}
