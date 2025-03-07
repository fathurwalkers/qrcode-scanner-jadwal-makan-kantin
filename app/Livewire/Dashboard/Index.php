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
        $date = '2025-01-30';
        $this->tanggalHariIni = Carbon::today()->toDateString();
        $this->counts = DB::table('jadwal')
            ->whereDate('jadwal_tanggal', $this->tanggalHariIni)
            ->selectRaw('
                COUNT(jadwal_cek_subuh) as subuh,
                COUNT(jadwal_cek_pagi) as pagi,
                COUNT(jadwal_cek_siang) as siang,
                COUNT(jadwal_cek_malam) as malam
            ')
            ->first();
        $this->jadwal = Jadwal::latest()->get();
        // dd($this->counts);
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
