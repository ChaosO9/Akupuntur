<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegistrasiPasien;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/403', function () {
    return view('403');
})->name('403');


Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('login', 'halamanLogin')->name('admin.login');
    Route::get('logout', 'logoutAdminSubmit')->name('admin.logout.submit');
    Route::post('login', 'loginAdminSubmit')->name('admin.login.submit');
    Route::middleware(['apakahAdmin'])->group(function () {
        Route::get('dashboard', 'halamanDashboard')->name('admin.dashboard');
        Route::get('data-pasien', 'halamanDataPasien')->name('admin.data.pasien');
        Route::post('data-pasien/hapus', 'dataPasienHapus')->name('admin.data.pasien.hapus');
        Route::get('jadwal-akupuntur', 'halamanDataJadwalAkupuntur')->name('admin.data.jadwal.akupuntur');
        Route::get('jadwal-akupuntur/{id}/hapus', 'hapusDataJadwalAkupuntur')->name('admin.data.jadwal.akupuntur.hapus');
        Route::get('jadwal-akupuntur/{id}/edit', 'halamanEditJadwalAkupuntur')->name('admin.jadwal.akupuntur.edit');
        Route::post('jadwal-akupuntur/{id}/edit', 'editDataJadwalAkupuntur')->name('admin.jadwal.akupuntur.edit.simpan');
    });
});

Route::get('/new', function () {
    return view('new');
});

Route::post('/registrasi-pasien', [RegistrasiPasien::class, 'registrasiPasien'])->name('registrasi.pasien');

Route::get('/jadwal-akupuntur', function () {
    return view('home');
})->name('reservasi.jadwal.akupuntur.pasien');
