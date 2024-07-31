<?php

namespace App\Livewire;

use App\Models\JadwalAkupuntur;
use Livewire\Component;

class FormEditJadwalAkupuntur extends Component
{
    public $jadwal;
    public $tanggal_akupuntur;
    public $nama;
    public $gender;
    public $nomor_telepon;
    public $jamLayananTersedia;
    public $disableWaktuLayanan;

    public function mount($jadwal)
    {
        $this->jadwal = $jadwal;
        $this->tanggal_akupuntur = $jadwal->tanggal_melakukan_terapi;
        $this->nama = $jadwal->nama;
        $this->gender = $jadwal->gender;
        $this->nomor_telepon = $jadwal->nomor_telepon;

        $dateString = $this->tanggal_akupuntur;
        $jamLayananSudahDibooking = JadwalAkupuntur::where('tanggal_melakukan_terapi', $dateString)->pluck('jam_pelayanan')->toArray();
        $jamLayanan = ['09.00', '10.00', '11.00', '14.00', '15.00', '16.00', '17.00', '19.00', '20.00'];
        $this->jamLayananTersedia = array_diff($jamLayanan, $jamLayananSudahDibooking);
        array_push($this->jamLayananTersedia, $jadwal->jam_pelayanan);
    }

    public function updateJamLayananTersedia()
    {
        $dateString = $this->tanggal_akupuntur;
        $jamLayananSudahDibooking = JadwalAkupuntur::where('tanggal_melakukan_terapi', $dateString)->pluck('jam_pelayanan')->toArray();

        $jamLayanan = ['09.00', '10.00', '11.00', '14.00', '15.00', '16.00', '17.00', '19.00', '20.00'];

        $jamLayananTersedia = array_diff($jamLayanan, $jamLayananSudahDibooking);

        $this->jamLayananTersedia = $jamLayananTersedia;
    }

    public function render()
    {
        return view('livewire.form-edit-jadwal-akupuntur');
    }
}
