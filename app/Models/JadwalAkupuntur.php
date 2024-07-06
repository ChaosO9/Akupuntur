<?php

namespace App\Models;

use DateTime;
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

    public static function periksaJamLayananTersedia($tanggal_akupuntur)
    {
        dd($tanggal_akupuntur);
        exit();

        $dateString = $tanggal_akupuntur;
        $dateTime = DateTime::createFromFormat('m/d/Y', $dateString);
        $tanggalTerapiTerformat = $dateTime->format('Y-m-d');
        $jamLayananSudahDibooking = JadwalAkupuntur::where('tanggal_melakukan_terapi', $tanggalTerapiTerformat)->get();

        // dd($jamLayananSudahDibooking);

        $jamLayanan = ['09.00', '10.00', '11.00', '14.00', '15.00', '16.00', '17.00', '19.00', '20.00'];

        $jamLayananTersedia = array_diff($jamLayanan, $jamLayananSudahDibooking);

        return $jamLayananTersedia;
    }
}
