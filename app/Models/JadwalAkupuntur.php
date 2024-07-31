<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAkupuntur extends Model
{
    use HasFactory;

    protected $table = 'jadwal_akupuntur';

    protected $fillable = [
        'nomor_kartu_pasien',
        'tanggal_melakukan_terapi',
        'jam_pelayanan',
        'keluhan',
        'status'
    ];

    public function users()
    {
        return $this->belongsTo(Pasien::class, 'nomor_kartu_pasien');
    }
}
