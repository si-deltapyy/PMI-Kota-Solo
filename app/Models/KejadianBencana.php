<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianBencana extends Model
{
    use HasFactory;

    protected $table = 'kejadian_bencana';
    protected $primaryKey = 'id_kejadian';
    public $timestamps = true;

    protected $fillable = [
        'id_jeniskejadian',
        'id_admin',
        'id_relawan',
        'tanggal_kejadian',
        'lokasi',
        'update',
        'dukungan_internasional',
        'keterangan',
        'akses_ke_lokasi',
        'kebutuhan',
        'giat_pemerintah',
        'hambatan',
        'id_assessment',
        'id_dampak',
        'id_mobilisasi_sd',
        'id_giat_pmi',
        'timestamp_input',
        'timestamp_update'
    ];

    // Define the relationships

    public function jenisKejadian()
    {
        return $this->belongsTo(JenisKejadian::class, 'id_jeniskejadian');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'id_admin');
    }

    public function relawan()
    {
        return $this->belongsTo(User::class, 'id_relawan');
    }

    public function assessment()
    {
        return $this->hasMany(Assessment::class, 'id_assessment');
    }

    public function mobilisasiSd()
    {
        return $this->belongsTo(MobilisasiSd::class, 'id_mobilisasi_sd');
    }

    public function giatPmi()
    {
        return $this->belongsTo(GiatPmi::class, 'id_giat_pmi');
    }
    public function dampak()
    {
        return $this->belongsTo(Dampak::class, 'id_dampak');
    }

    public function narahubung()
    {
        return $this->hasMany(PersonilNarahubung::class, 'id_narahubung');
    }

    public function petugasPosko()
    {
        return $this->hasMany(PetugasPosko::class, 'id_petugas_posko');
    }

    public function dokumentasi()
    {
        return $this->hasMany(LampiranDokumentasi::class, 'id_dokumentasi');
    }

    public function pengungsian()
    {
        return $this->hasMany(Pengungsian::class, 'id_pengungsian');
    }

}
