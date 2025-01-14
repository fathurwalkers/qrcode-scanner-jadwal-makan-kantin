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
        $this->qr_input = '';
    }

    public function searchData($inputPass)
    {
        $now = Carbon::now($this->timezone);
        $decryptedData = Crypt::decryptString($inputPass);
        $explodeInputRequest = explode("#", $decryptedData);
        $data = Data::where('data_nama', $explodeInputRequest[0])
            ->where('data_no_id_card', $explodeInputRequest[1])
            ->first();
        if ($data) {
            $tanggalHariIni = $now->toDateString();
            $currentHour = $now->hour;
            $this->nama = $data->data_nama;
            $this->tanggalwaktu = $now->toDateTimeString();
            $jadwalCek = [
                'subuh' => 'TIDAK',
                'pagi' => 'TIDAK',
                'siang' => 'TIDAK',
                'malam' => 'TIDAK'
            ];
            $jadwalJam = [
                'subuh' => null,
                'pagi' => null,
                'siang' => null,
                'malam' => null
            ];
            $rentangWaktu = '';
            if ($currentHour >= 4 && $currentHour < 9) {
                $rentangWaktu = 'pagi';
            } elseif ($currentHour >= 9 && $currentHour < 15) {
                $rentangWaktu = 'siang';
            } elseif ($currentHour >= 15 && $currentHour < 19) {
                $rentangWaktu = 'malam';
            } elseif ($currentHour >= 0 && $currentHour < 4 || $currentHour >= 19 && $currentHour < 24) {
                $rentangWaktu = 'subuh';
            }
            $jadwalCek[$rentangWaktu] = 'YA';
            $jadwalJam[$rentangWaktu] = $now->toTimeString();
            $existingJadwal = Jadwal::where('jadwal_tanggal', $tanggalHariIni)
                ->where('data_id', $data->id)
                ->where("jadwal_cek_{$rentangWaktu}", 'YA')
                ->first();
            if ($existingJadwal) {
                $existingJadwal->update([
                    "jadwal_tanggal" => $tanggalHariIni,
                    "jadwal_jam_{$rentangWaktu}" => $jadwalJam[$rentangWaktu],
                    "updated_at" => now()
                ]);
                $this->{$rentangWaktu} = 'YA';
                $this->{"waktu_scan_{$rentangWaktu}"} = $jadwalJam[$rentangWaktu];
            } else {
                Jadwal::create([
                    'jadwal_tanggal' => $tanggalHariIni,
                    'jadwal_cek_subuh' => $jadwalCek['subuh'],
                    'jadwal_cek_pagi' => $jadwalCek['pagi'],
                    'jadwal_cek_siang' => $jadwalCek['siang'],
                    'jadwal_cek_malam' => $jadwalCek['malam'],
                    'jadwal_jam_subuh' => $jadwalJam['subuh'],
                    'jadwal_jam_pagi' => $jadwalJam['pagi'],
                    'jadwal_jam_siang' => $jadwalJam['siang'],
                    'jadwal_jam_malam' => $jadwalJam['malam'],
                    'jadwal_status' => 'Active',
                    'data_id' => $data->id,
                    'periode_id' => NULL,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $this->{$rentangWaktu} = 'YA';
                $this->{"waktu_scan_{$rentangWaktu}"} = $jadwalJam[$rentangWaktu];
            }
        } else {
            $this->nama = "Data tidak Valid!";
        }
    }

    public function render()
    {
        return view('livewire.home.index');
    }
}
