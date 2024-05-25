<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KorbanTerdampak extends Model
{
    use HasFactory;

    protected $table = 'korban_terdampak';
    protected $primaryKey = 'id_korban_terdampak';
    protected $fillable = [
        'fk2_id_kerusakan_rumah',
        'jiwa',
    ];

    public function kerusakanRumah()
    {
        return $this->belongsTo(KerusakanRumah::class, 'fk2_id_kerusakan_rumah');
    }
}
