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
    public $no_karyawan = "Tidak ada Data";
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

    public $jadwal;
    public $tanggalHariIni;
    public $counts;

    public function store()
    {
        $this->searchData($this->qr_input);
        $this->qr_input = '';
    }

    public function decryptQrData($encryptedData)
    {
        $key = 'fathur-ganteng';
        list($encrypted, $iv) = explode('::', base64_decode($encryptedData));
        $iv = base64_decode($iv);
        $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
        return $decrypted;
    }

    public function searchData($inputPass)
    {
        $now = Carbon::now($this->timezone);

        // Cek apakah inputPass adalah string terenkripsi AES atau hanya string biasa
        $isEncrypted = false;

        // Coba decode base64
        $decoded = base64_decode($inputPass, true);
        if ($decoded !== false) {
            $parts = explode('::', $decoded);
            if (count($parts) === 2) {
                $isEncrypted = true;
            }
        }

        // Debugging: Ganti dd untuk melihat jenis data
        if (!$isEncrypted) {
            return redirect()->route('home')->with('status', 'Terjadi kesalahan, silahkan melakukan scan ulang.');
        }

        $decryptedData = $this->decryptQrData($inputPass);
        $explodeInputRequest = explode("#", $decryptedData);
        $data = Data::where('data_nama', $explodeInputRequest[0])
            ->where('data_no_id_card', $explodeInputRequest[1])
            ->first();
        if ($data === null) {
            $data = Data::where('data_unique_id', $explodeInputRequest[0])
            ->where('data_no_id_card', $explodeInputRequest[1])
            ->first();
        }
        if ($data === null) {
            if (strlen($explodeInputRequest[1]) > 5) {
                $ambil_no_id_card = substr($explodeInputRequest[1], -5);
            } elseif (strlen($explodeInputRequest[1]) === 5) {
                $ambil_no_id_card = $explodeInputRequest[1];
            } else {
                $ambil_no_id_card = null;
            }
            $data = Data::where('data_no_id_card', $ambil_no_id_card)
            ->first();
        }
        if ($data) {
            $tanggalHariIni = $now->toDateString();
            $currentHour = $now->hour;
            $this->nama = $data->data_nama;
            $this->no_karyawan = $data->data_no_id_card;
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
            if (($currentHour >= 22) || ($currentHour == 2 && $now->minute <= 30)) {
                $rentangWaktu = 'subuh';
            } elseif (($currentHour >= 3 && $currentHour < 5) || ($currentHour == 5 && $now->minute <= 59)) {
                $rentangWaktu = 'siang';
            } elseif ($currentHour >= 6 && ($currentHour < 8 || ($currentHour == 8 && $now->minute <= 30))) {
                $rentangWaktu = 'pagi';
            } elseif ($currentHour >= 11 && $currentHour < 13) {
                $rentangWaktu = 'siang';
            } elseif (($currentHour == 16 && $now->minute >= 30) || ($currentHour >= 17 && $currentHour < 19)) {
                $rentangWaktu = 'malam';
            } else {
                $rentangWaktu = '';
            }
            if ($rentangWaktu == "") {
                session('ok');
            } else {
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
            }
            session()->flash('status', 'Scan berhasil! Data telah dicatat.');
        } else {
            $this->nama = "Data tidak Valid!";
        }
    }

    public function render()
    {
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
        return view('livewire.home.index', [
            'counts' => $this->counts,
        ]);
    }
}
