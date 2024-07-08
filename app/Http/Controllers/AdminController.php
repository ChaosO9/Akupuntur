<?php

namespace App\Http\Controllers;

use App\Models\JadwalAkupuntur;
use App\Models\Pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function halamanLogin()
    {
        return view('auth.login_admin');
    }

    public function halamanDashboard()
    {
        $pasien = Pasien::all();
        $jadwal = JadwalAkupuntur::all();
        return view('admin.index', compact('pasien', 'jadwal'));
    }

    public function halamanDataPasien()
    {
        $pasien = Pasien::all();
        return view('admin.pasien', ['pasien' => $pasien]);
    }

    public function halamanDataJadwalAkupuntur()
    {
        $jadwal = DB::table('jadwal_akupuntur')->get();
        $jadwalWithNama = $jadwal->map(function ($item) {
            $jadwal = JadwalAkupuntur::find($item->id);
            $item->nama = $jadwal->users()->pluck('nama')->all();
            $item->gender = $jadwal->users()->pluck('gender')->all();
            $item->nomor_telepon = $jadwal->users()->pluck('nomor_telepon')->all();
            return $item;
        });

        return view('admin.jadwal-akupuntur', ['jadwal_akupuntur' => $jadwal]);
    }

    public function hapusDataPasien(Request $request)
    {
        $pasien = Pasien::find($request->id);
        $pasien->delete();
        return redirect()->back();
    }

    public function hapusDataJadwalAkupuntur(Request $request)
    {
        $jadwal = JadwalAkupuntur::find($request->id);
        $jadwal->delete();
        return redirect()->back();
    }

    public function loginAdminSubmit(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string', // Adjust validation rules as needed
            'password' => 'required|string',
        ]);


        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->hasRole('admin')) {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'Akun yang anda masukkan bukanlah akun Admin',
                ]);
            }
        }

        $user = User::where('username', $request->username)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'Tidak ada akun ' . $request->id . ' tercatat di database',
            ]);
        }

        return back()->withErrors([
            'email' => 'Username/Kata Sandi Salah',
        ]);
    }

    public function logoutAdminSubmit(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
