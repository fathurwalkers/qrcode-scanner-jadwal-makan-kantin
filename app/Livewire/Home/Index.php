<?php

namespace App\Livewire\Home;

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
    #[Title('QR Scanner App - PT. KPA')]
    public $timezone = 'Asia/Makassar';

    public $nama = "Tidak ada Data";
    public $subuh = "TIDAK";
    public $pagi = "TIDAK";
    public $siang = "TIDAK";
    public $malam = "TIDAK";
    public $waktu_scan_subuh = null;
    public $waktu_scan_pagi = null;
    public $waktu_scan_siang = null;
    public $waktu_scan_malam = null;
    public $tanggalwaktu = "Tidak ada Data";
    public $qr_input;

    public function store()
    {
        $this->searchData($this->qr_input);
    }

    public function searchData($inputPass)
    {
        $now = Carbon::now($this->timezone);
        $decryptedData = Crypt::decryptString($inputPass);
        $explodeInputRequest = explode("#", $decryptedData);
        $data = Data::where('data_nama', $explodeInputRequest[0])
            ->where('data_no_id_card', $explodeInputRequest[1])
            ->first();

        if ($data == true) {
            $jadwal = new Jadwal;

            $tanggalHariIni = $now->toDateString();
            $currentHour = $now->hour;

            $this->nama = $data->data_nama;
            $this->tanggalwaktu = $now->toDateTimeString();

            $this->subuh = 'TIDAK';
            $this->pagi = 'TIDAK';
            $this->siang = 'TIDAK';
            $this->malam = 'TIDAK';

            if ($currentHour >= 4 && $currentHour < 9) {
                $this->pagi = 'YA';
                $this->waktu_scan_pagi = $now->toTimeString();
            } elseif ($currentHour >= 9 && $currentHour < 15) {
                $this->siang = 'YA';
                $this->waktu_scan_siang = $now->toTimeString();
            } elseif ($currentHour >= 15 && $currentHour < 19) {
                $this->malam = 'YA';
                $this->waktu_scan_malam = $now->toTimeString();
            } elseif ($currentHour >= 0 && $currentHour < 4 || $currentHour >= 19 && $currentHour < 24) {
                $this->subuh = 'YA';
                $this->waktu_scan_subuh = $now->toTimeString();
            }

            $jadwal->create([
                'jadwal_tanggal' => $tanggalHariIni,
                'jadwal_cek_subuh' => $this->subuh,
                'jadwal_cek_pagi' => $this->pagi,
                'jadwal_cek_siang' => $this->siang,
                'jadwal_cek_malam' => $this->malam,
                'jadwal_jam_subuh' => $this->waktu_scan_subuh,
                'jadwal_jam_pagi' => $this->waktu_scan_pagi,
                'jadwal_jam_siang' => $this->waktu_scan_siang,
                'jadwal_jam_malam' => $this->waktu_scan_malam,
                'jadwal_status' => 'Active',
                'data_id' => $data->id,
                'periode_id' => NULL,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        } else {
            $this->nama = "Data tidak Valid!";
        }
    }

    public function render()
    {
        return view('livewire.home.index');
    }
}
