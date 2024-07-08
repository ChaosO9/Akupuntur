<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;

class RegistrasiPasien extends Controller
{
    public function registrasiPasien(Request $request)
    {
        $timestamp = date('YmdHis');
        $randomNumber = rand(100, 999);
        $prefix = 'AKP';
        $nomor_pasien = strtoupper($prefix . $timestamp . str_pad($randomNumber, 3, '0', STR_PAD_LEFT));

        $status_pengobatan = $request->input('status-pengobatan-pasien-registrasi') === "true" ? true : false;

        $dateString = $request->input('tanggal-lahir-pasien-registrasi'); // Example date string
        $dateTime = DateTime::createFromFormat('m/d/Y', $dateString); // Create a DateTime object from the string
        $formattedDateString = $dateTime->format('Y-m-d');

        Pasien::create([
            'id' => $nomor_pasien,
            'nama' => $request->input('nama-pasien-registrasi'),
            'tanggal_lahir' => $formattedDateString,
            'gender' => $request->input('gender-pasien-registrasi'),
            'pekerjaan' => $request->input('pekerjaan-pasien-registrasi'),
            'nomor_telepon' => $request->input('nomor-hp-registrasi'),
            'sedang_melakukan_pengobatan' => $status_pengobatan,
        ]);

        return back()->with('message', 'Registrasi pasien berhasil!\n Nomor Pasien Anda: ' . $nomor_pasien . '\nHarap simpan nomor pasien Anda!');
    }
}
