<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranDokumentasi extends Model
{
    use HasFactory;

    protected $table = 'lampiran_dokumentasi';
    protected $primaryKey = 'id_dokumentasi';
    protected $fillable = [
        'file_dokumentasi',
    ];
}
