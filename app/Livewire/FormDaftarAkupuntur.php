<?php

namespace App\Livewire;

use App\Http\Controllers\CekKetersediaanJamPelayanan;
use App\Models\JadwalAkupuntur;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FormDaftarAkupuntur extends Component
{
    public $kartu_pasien = '';
    public $nama = '';
    public $nomor_telepon = '';
    public $gender = '';
    public $pekerjaan = '';
    public $tanggal_lahir = '';
    public $sedang_melakukan_pengobatan = '';

    public $tanggal_akupuntur = null;
    public $jam_pelayanan_tersedia = '';

    public $modeButton = 'Cek Pasien';
    public $error_cari_user = null;

    protected $listeners = [
        'updateJamLayananTersedia' => 'updateJamPelayananTersedia',
    ];

    public function getPasien()
    {
        $user = User::find($this->kartu_pasien);

        if ($user) {
            session()->flash('sukses_cari_user', 'Silahkan ubah data Anda jika perlu!');
            $this->modeButton = 'Ganti Pasien';
            $this->tanggal_akupuntur = date('Y-m-d');
            $this->updateJamLayananTersedia();


            $this->nama = $user->nama;
            $this->nomor_telepon = $user->nomor_telepon;
            $this->gender = $user->gender;
            $this->pekerjaan = $user->pekerjaan;
            $this->tanggal_lahir = $user->tanggal_lahir;
            $this->sedang_melakukan_pengobatan = $user->sedang_melakukan_pengobatan;
        } else {
            // abort(404);
            session()->flash('error_cari_user', 'Gagal menemukan pasien');
            $this->reset(['nama', 'nomor_telepon', 'gender', 'pekerjaan', 'tanggal_lahir', 'sedang_melakukan_pengobatan']);
            // $this->error_cari_user = 'Gagal menemukan pasien';
        }
    }

    public function gantiPasien()
    {
        $this->modeButton = 'Cek Pasien';
        $this->reset(['nama', 'nomor_telepon', 'gender', 'pekerjaan', 'tanggal_lahir', 'sedang_melakukan_pengobatan']);
    }

    public function updateJamLayananTersedia()
    {
        $dateString = $this->tanggal_akupuntur;
        $jamLayananSudahDibooking = JadwalAkupuntur::where('tanggal_melakukan_terapi', $dateString)->pluck('jam_pelayanan')->toArray();

        $jamLayanan = ['09.00', '10.00', '11.00', '14.00', '15.00', '16.00', '17.00', '19.00', '20.00'];

        $jamLayananTersedia = array_diff($jamLayanan, $jamLayananSudahDibooking);

        $this->jam_pelayanan_tersedia = $jamLayananTersedia;
    }

    public function render()
    {
        return view('livewire.form-daftar-akupuntur');
    }
}
