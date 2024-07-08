<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nama',
        'tanggal_lahir',
        'gender',
        'pekerjaan',
        'nomor_telepon',
        'sedang_melakukan_pengobatan',
    ];

    public function jadwalAkupuntur()
    {
        return $this->hasMany(JadwalAkupuntur::class);
    }
}
