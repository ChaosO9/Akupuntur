<?php

use App\Http\Controllers\RegistrasiPasien;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/new', function () {
    return view('new');
});

Route::post('/registrasi-pasien', [RegistrasiPasien::class, 'registrasiPasien'])->name('registrasi.pasien');
