<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonilNarahubung extends Model
{
    use HasFactory;

    protected $table = 'personil_narahubung';
    protected $primaryKey = 'id_narahubung';
    protected $fillable = [
        'nama_lengkap',
        'posisi',
        'kontak',
    ];
}
