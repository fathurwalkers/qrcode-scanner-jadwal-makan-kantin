<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\Login;
use App\Models\Jadwal;
use App\Models\Data;
use App\Models\Periode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class Index extends Component
{
    public $title = 'Dashboard Manajemen Penjadwalan';

    public $jadwal;
    public $tanggalHariIni;
    public $counts;

    public function render()
    {
        $date = '2025-02-11';
        $this->tanggalHariIni = Carbon::today()->toDateString();
        $this->counts = DB::table('jadwal')
            ->whereDate('jadwal_tanggal', $this->tanggalHariIni)
            ->selectRaw('
                SUM(CASE WHEN jadwal_cek_subuh = "YA" THEN 1 ELSE 0 END) as subuh,
                SUM(CASE WHEN jadwal_cek_pagi = "YA" THEN 1 ELSE 0 END) as pagi,
                SUM(CASE WHEN jadwal_cek_siang = "YA" THEN 1 ELSE 0 END) as siang,
                SUM(CASE WHEN jadwal_cek_malam = "YA" THEN 1 ELSE 0 END) as malam
            ')
            ->first();
        $this->jadwal = Jadwal::latest()->get();
        return view('livewire.dashboard.index')
            ->layout('layouts.dashboard-layout', [
                'title' => $this->title,
                'counts' => $this->counts,
            ]);
    }

    public function layoutData()
    {
        return [
            'title' => $this->title,
        ];
    }
}
