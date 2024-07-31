<?php

namespace App\Livewire;

use App\Http\Controllers\CekKetersediaanJamPelayanan;
use App\Models\JadwalAkupuntur;
use App\Models\Pasien;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Locked;
use Livewire\Component;

class FormDaftarAkupuntur extends Component
{
    public Pasien $pasien;
    public function __construct()
    {
        $this->pasien = new Pasien(); // Initialize with a new User instance
    }

    #[Locked]
    public $user;

    public $kartu_pasien = '';
    public $nama = '';
    public $nomor_telepon = '';
    public $gender = '';
    public $pekerjaan = '';
    public $tanggal_lahir = '';
    public $sedang_melakukan_pengobatan = '';
    public $keluhan = null;

    public $tanggal_akupuntur = null;
    public $jam_pelayanan_tersedia = '';
    public $jamLayananTersedia;

    public $modeButton = 'Cek Pasien';
    public $error_cari_user = null;

    protected $listeners = [
        'updateJamLayananTersedia' => 'updateJamPelayananTersedia',
    ];

    public function getPasien()
    {
        $this->user = $this->pasien::find($this->kartu_pasien);

        if ($this->user) {
            session()->flash('sukses_cari_user', 'Silahkan ubah data Anda jika perlu!');
            $this->user->id = $this->kartu_pasien;
            $this->modeButton = 'Ganti Pasien';
            $this->tanggal_akupuntur = date('Y-m-d');
            $this->updateJamLayananTersedia();

            $this->nama = $this->user->nama;
            $this->nomor_telepon = $this->user->nomor_telepon;
            $this->gender = $this->user->gender;
            $this->pekerjaan = $this->user->pekerjaan;
            $this->tanggal_lahir = $this->user->tanggal_lahir;
            $this->sedang_melakukan_pengobatan = $this->user->sedang_melakukan_pengobatan;
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

        $this->jamLayananTersedia = $jamLayananTersedia;
    }

    public function jadwalkanAkupuntur()
    {
        $pasien_data_baru = Pasien::find($this->user->id)->update([
            "nama" => $this->nama,
            "tanggal_lahir" => $this->tanggal_lahir,
            "gender" => $this->gender,
            "pekerjaan" => $this->pekerjaan,
            "nomor_telepon" => $this->nomor_telepon,
            "sedang_melakukan_pengobatan" => $this->sedang_melakukan_pengobatan,
        ]);

        // $data_baru = [
        //     "nama" => $this->nama,
        //     "tanggal_lahir" => $this->tanggal_lahir,
        //     "gender" => $this->gender,
        //     "pekerjaan" => $this->pekerjaan,
        //     "nomor_telepon" => $this->nomor_telepon,
        //     "sedang_melakukan_pengobatan" => $this->sedang_melakukan_pengobatan,
        // ];

        // dd($data_baru);
        // exit();

        JadwalAkupuntur::create([
            'nomor_kartu_pasien' => $this->user->id,
            'tanggal_melakukan_terapi' => $this->tanggal_akupuntur,
            'jam_pelayanan' => $this->jam_pelayanan_tersedia,
            'keluhan' => ($this->keluhan == null ? '' : $this->keluhan),
            'status' => 'Belum Dilayani'
        ]);

        return redirect()->route('reservasi.jadwal.akupuntur.pasien')->with('message', 'Sukses jadwalkan akupuntur Anda pada:\n' . 'Tanggal: ' . $this->tanggal_akupuntur . '\nJam: ' . $this->jam_pelayanan_tersedia);
    }

    public function render()
    {
        return view('livewire.form-daftar-akupuntur');
    }
}