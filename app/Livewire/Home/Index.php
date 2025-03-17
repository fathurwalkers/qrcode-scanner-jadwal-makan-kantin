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
    public $title;

    public function store()
    {
        $this->searchData($this->qr_input);
        $this->qr_input = '';
    }

    public function decryptQrData($encryptedData)
    {
        $key = env('AES_KEY');
        list($encrypted, $iv) = explode('::', base64_decode($encryptedData));
        $iv = base64_decode($iv);
        $decrypted = openssl_decrypt($encrypted, 'aes-256-cbc', $key, 0, $iv);
        return $decrypted;
    }

    public function searchData($inputPass)
    {
        $this->subuh = "TIDAK";
        $this->pagi = "TIDAK";
        $this->siang = "TIDAK";
        $this->malam = "TIDAK";
        $this->waktu_scan_subuh = NULL;
        $this->waktu_scan_pagi = NULL;
        $this->waktu_scan_siang = NULL;
        $this->waktu_scan_malam = NULL;
        $now = Carbon::now($this->timezone);
        $isEncrypted = false;
        $decoded = base64_decode($inputPass, true);
        if ($decoded !== false) {
            $parts = explode('::', $decoded);
            if (count($parts) === 2) {
                $isEncrypted = true;
            }
        }
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

            if (
                ($currentHour >= 22) ||  // 22:00 - 23:59
                ($currentHour < 2) ||   // 00:00 - 01:59
                ($currentHour == 2 && $now->minute <= 59) // 02:00 - 02:59
            ) {
                $rentangWaktu = 'subuh';
            } elseif (
                ($currentHour == 6) ||  // 06:00
                ($currentHour >= 7 && $currentHour < 8) ||   // 07:00 - 07:59
                ($currentHour == 8 && $now->minute <= 30) // 08:00 - 08:30
            ) {
                $rentangWaktu = 'pagi';
            } elseif (
                ($currentHour == 11) ||  // 11:00
                ($currentHour >= 12 && $currentHour < 13) ||   // 12:00 - 12:59
                ($currentHour == 3) ||   // 03:00 - 03:59
                ($currentHour == 4 && $now->minute <= 30) // 04:00 - 04:30
            ) {
                $rentangWaktu = 'siang';
            } elseif (
                ($currentHour == 16 && $now->minute >= 30) ||  // 16:30 ke atas
                ($currentHour >= 17 && $currentHour < 19) ||   // 17:00 - 18:59
                ($currentHour == 19 && $now->minute == 0)      // 19:00 pas
            ) {
                $rentangWaktu = 'malam';
            }
            if ($rentangWaktu == "") {
                session('ok');
                $jadwal_exist =  Jadwal::where('jadwal_tanggal', $tanggalHariIni)
                    ->where('data_id', $data->id)
                    ->first();
                if (!$jadwal_exist) {
                    session()->flash('status', 'Maaf, anda melakukan scan diluar jadwal makan yang telah dilakukan.');
                    return;
                }
                $jadwalCek = [
                    'subuh' => $jadwal_exist->jadwal_cek_subuh,
                    'pagi' => $jadwal_exist->jadwal_cek_pagi,
                    'siang' => $jadwal_exist->jadwal_cek_siang,
                    'malam' => $jadwal_exist->jadwal_cek_malam
                ];
                $jadwalJam = [
                    'subuh' => $jadwal_exist->jadwal_jam_subuh,
                    'pagi' => $jadwal_exist->jadwal_jam_pagi,
                    'siang' => $jadwal_exist->jadwal_jam_siang,
                    'malam' => $jadwal_exist->jadwal_jam_malam
                ];
                $this->subuh = $jadwalCek["subuh"];
                $this->pagi = $jadwalCek["pagi"];
                $this->siang = $jadwalCek["siang"];
                $this->malam = $jadwalCek["malam"];
                $this->waktu_scan_subuh = $jadwalJam["subuh"];
                $this->waktu_scan_pagi = $jadwalJam["pagi"];
                $this->waktu_scan_siang = $jadwalJam["siang"];
                $this->waktu_scan_malam = $jadwalJam["malam"];
                session()->flash('status', 'Maaf, anda melakukan scan diluar jadwal makan yang telah dilakukan, silahkan melakukan scan pada jadwal makan yang telah ditentukan.');
            } else {
                $jadwalCek[$rentangWaktu] = 'YA';
                $jadwalJam[$rentangWaktu] = $now->toTimeString();
                $existingJadwal =  Jadwal::where('jadwal_tanggal', $tanggalHariIni)
                    ->where('data_id', $data->id)
                    ->first();
                if ($existingJadwal) {
                    $existingJadwal->update([
                        'jadwal_tanggal' => $tanggalHariIni,
                        'jadwal_cek_subuh' => ($existingJadwal->jadwal_cek_subuh === "TIDAK" || is_null($existingJadwal->jadwal_jam_subuh)) ? $jadwalCek['subuh'] : $existingJadwal->jadwal_cek_subuh,
                        'jadwal_cek_pagi' => ($existingJadwal->jadwal_cek_pagi === "TIDAK" || is_null($existingJadwal->jadwal_jam_pagi)) ? $jadwalCek['pagi'] : $existingJadwal->jadwal_cek_pagi,
                        'jadwal_cek_siang' => ($existingJadwal->jadwal_cek_siang === "TIDAK" || is_null($existingJadwal->jadwal_jam_siang)) ? $jadwalCek['siang'] : $existingJadwal->jadwal_cek_siang,
                        'jadwal_cek_malam' => ($existingJadwal->jadwal_cek_malam === "TIDAK" || is_null($existingJadwal->jadwal_jam_malam)) ? $jadwalCek['malam'] : $existingJadwal->jadwal_cek_malam,
                        'jadwal_jam_subuh' => !empty($jadwalJam['subuh']) ? $jadwalJam['subuh'] : $existingJadwal->jadwal_jam_subuh,
                        'jadwal_jam_pagi' => !empty($jadwalJam['pagi']) ? $jadwalJam['pagi'] : $existingJadwal->jadwal_jam_pagi,
                        'jadwal_jam_siang' => !empty($jadwalJam['siang']) ? $jadwalJam['siang'] : $existingJadwal->jadwal_jam_siang,
                        'jadwal_jam_malam' => !empty($jadwalJam['malam']) ? $jadwalJam['malam'] : $existingJadwal->jadwal_jam_malam,

                        'updated_at' => now()
                    ]);
                    $jadwal_exist =  Jadwal::where('jadwal_tanggal', $tanggalHariIni)
                        ->where('data_id', $data->id)
                        ->first();
                    $jadwalCek = [
                        'subuh' => $jadwal_exist->jadwal_cek_subuh === "TIDAK" ? $jadwalCek['subuh'] : $jadwal_exist->jadwal_cek_subuh,
                        'pagi' => $jadwal_exist->jadwal_cek_pagi === "TIDAK" ? $jadwalCek['pagi'] : $jadwal_exist->jadwal_cek_pagi,
                        'siang' => $jadwal_exist->jadwal_cek_siang === "TIDAK" ? $jadwalCek['siang'] : $jadwal_exist->jadwal_cek_siang,
                        'malam' => $jadwal_exist->jadwal_cek_malam === "TIDAK" ? $jadwalCek['malam'] : $jadwal_exist->jadwal_cek_malam
                    ];
                    $jadwalJam = [
                        'subuh' => !empty($jadwalJam['subuh']) ? $jadwalJam['subuh'] : $jadwal_exist->jadwal_jam_subuh,
                        'pagi' => !empty($jadwalJam['pagi']) ? $jadwalJam['pagi'] : $jadwal_exist->jadwal_jam_pagi,
                        'siang' => !empty($jadwalJam['siang']) ? $jadwalJam['siang'] : $jadwal_exist->jadwal_jam_siang,
                        'malam' => !empty($jadwalJam['malam']) ? $jadwalJam['malam'] : $jadwal_exist->jadwal_jam_malam
                    ];
                    $rentangWaktu = '';
                    if ($jadwalJam['subuh'] !== null) {
                        $rentangWaktu = 'subuh';
                    } elseif ($jadwalJam['pagi'] !== null) {
                        $rentangWaktu = 'pagi';
                    } elseif ($jadwalJam['siang'] !== null) {
                        $rentangWaktu = 'siang';
                    } elseif ($jadwalJam['malam'] !== null) {
                        $rentangWaktu = 'malam';
                    } else {
                        $rentangWaktu = '';
                    }
                    $this->subuh = $jadwalCek["subuh"];
                    $this->pagi = $jadwalCek["pagi"];
                    $this->siang = $jadwalCek["siang"];
                    $this->malam = $jadwalCek["malam"];
                    $this->waktu_scan_subuh = $jadwalJam["subuh"];
                    $this->waktu_scan_pagi = $jadwalJam["pagi"];
                    $this->waktu_scan_siang = $jadwalJam["siang"];
                    $this->waktu_scan_malam = $jadwalJam["malam"];
                    session()->flash('status', 'Scan berhasil! Data telah diperbarui.');
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
                    session()->flash('status', 'Scan berhasil! Data telah dicatat.');
                }
            }
            // session()->flash('status', 'Scan berhasil! Data telah dicatat.');
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
        $this->title = 'QR Scanner App - PT. KPA';
        return view('livewire.home-index-test', [
            'counts' => $this->counts,
            'title' => $this->title,
        ]);
    }
}
