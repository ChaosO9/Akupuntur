<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAkupuntur extends Model
{
    use HasFactory;

    protected $table = 'jadwal_akupuntur';

    public function user()
    {
        return $this->belongsTo(User::class, 'nomor_kartu_pasien', 'id');
    }
}
