<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\Login;
use App\Models\Data;
use App\Models\Jadwal;
use App\Models\Periode;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class GenerateController extends Controller
{
    public function generate_login()
    {
        // ADMINISTRATOR
        $token = Str::random(16);
        $role = "admin";
        $hashPassword = Hash::make('jancok', [
            'rounds' => 12,
        ]);
        $hashToken = Hash::make($token, [
            'rounds' => 12,
        ]);
        Login::create([
            'login_nama' => 'Fathur',
            'login_username' => 'fathurwalkers',
            'login_password' => $hashPassword,
            'login_email' => 'muhfathur@indoasphalt.com',
            'login_telepon' => '0808080808',
            'login_token' => $hashToken,
            'login_level' => $role,
            'login_status' => "verified",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // ADMINISTRATOR 2
        $token = Str::random(16);
        $role = "admin";
        $hashPassword = Hash::make('xl920228', [
            'rounds' => 12,
        ]);
        $hashToken = Hash::make($token, [
            'rounds' => 12,
        ]);
        Login::create([
            'login_nama' => 'Administrator',
            'login_username' => 'admin',
            'login_password' => $hashPassword,
            'login_email' => 'admin@indoasphalt.com',
            'login_telepon' => '083400592841',
            'login_token' => $hashToken,
            'login_level' => $role,
            'login_status' => "verified",
            'created_at' => now(),
            'updated_at' => now()
        ]);

        echo "Berhasil Generate Data Login Admin!";
    }

    public function generateRandomTime($startHour, $startMinute, $endHour, $endMinute)
    {
        $startTime = $startHour * 60 + $startMinute;
        $endTime = $endHour * 60 + $endMinute;
        $randomMinuteOfDay = rand($startTime, $endTime);
        $randomHour = intdiv($randomMinuteOfDay, 60);
        $randomMinute = $randomMinuteOfDay % 60;
        return sprintf('%02d:%02d:00', $randomHour, $randomMinute);
    }

    public function generate_jadwal()
    {
        $tanggalHariIni = '2025-01-30';
        $allData = Data::all();
        if ($allData->isEmpty()) {
            echo "Tidak ada data di tabel Data.";
            return;
        }
        $timeRanges = [
            'subuh' => ['startHour' => 3, 'startMinute' => 0, 'endHour' => 4, 'endMinute' => 40],
            'pagi' => ['startHour' => 6, 'startMinute' => 0, 'endHour' => 8, 'endMinute' => 30],
            'siang' => ['startHour' => 11, 'startMinute' => 0, 'endHour' => 12, 'endMinute' => 59],
            'malam' => ['startHour' => 16, 'startMinute' => 30, 'endHour' => 18, 'endMinute' => 59],
        ];
        for ($i = 1; $i <= 20; $i++) {
            $data = Data::find(184);
            $jadwalExisting = Jadwal::where('data_id', $data->id)
                ->whereDate('jadwal_tanggal', $tanggalHariIni)
                ->first();
            $selectedRange = array_rand($timeRanges);
            $randomTime = $this->generateRandomTime(
                $timeRanges[$selectedRange]['startHour'],
                $timeRanges[$selectedRange]['startMinute'],
                $timeRanges[$selectedRange]['endHour'],
                $timeRanges[$selectedRange]['endMinute']
            );
            if ($jadwalExisting) {
                if ($jadwalExisting["jadwal_cek_{$selectedRange}"] === 'TIDAK') {
                    $jadwalExisting->update([
                        "jadwal_cek_{$selectedRange}" => 'YA',
                        "jadwal_jam_{$selectedRange}" => $randomTime,
                        'updated_at' => now(),
                    ]);
                    echo "Jadwal untuk {$data->data_nama} diperbarui pada {$selectedRange} dengan waktu {$randomTime}. <br />";
                } else {
                    echo "Jadwal untuk {$data->data_nama} sudah ada pada {$selectedRange}. Tidak ada perubahan. <br />";
                }
            } else {
                Jadwal::create([
                    'jadwal_tanggal' => $tanggalHariIni,
                    'jadwal_cek_subuh' => ($selectedRange === 'subuh') ? 'YA' : 'TIDAK',
                    'jadwal_cek_pagi' => ($selectedRange === 'pagi') ? 'YA' : 'TIDAK',
                    'jadwal_cek_siang' => ($selectedRange === 'siang') ? 'YA' : 'TIDAK',
                    'jadwal_cek_malam' => ($selectedRange === 'malam') ? 'YA' : 'TIDAK',
                    'jadwal_jam_subuh' => ($selectedRange === 'subuh') ? $randomTime : null,
                    'jadwal_jam_pagi' => ($selectedRange === 'pagi') ? $randomTime : null,
                    'jadwal_jam_siang' => ($selectedRange === 'siang') ? $randomTime : null,
                    'jadwal_jam_malam' => ($selectedRange === 'malam') ? $randomTime : null,
                    'jadwal_status' => 'Active',
                    'data_id' => $data->id,
                    'periode_id' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                echo "Data jadwal untuk {$data->data_nama} berhasil dibuat pada rentang waktu {$selectedRange} dengan waktu {$randomTime}. <br />";
            }
        }
    }

    public function generate_qr()
    {
        $data = Data::all();
        foreach ($data as $dt) {
            $qr = QrCode::format('png')->size(500)
                ->eye('circle')
                ->color(0, 0, 0)
                ->margin(2)
                ->generate($dt->data_qr);
            $qrImageName = $dt->data_nama . ' - ' . '(' . $dt->data_no_id_card . ')' . '.png';
            $qrPath = public_path('qr/' . $qrImageName);
            if (file_exists($qrPath)) {
                echo "File $qrImageName sudah ada, skip...\n <br />";
                \Log::info('File: ' . $qrImageName . ' sudah ada, skip...');
                continue;
            }
            $saved = file_put_contents($qrPath, $qr);
            if ($saved) {
                echo "Berhasil generate QR untuk: $dt->data_nama\n";
                \Log::info('File: ' . $qrImageName . ' berhasil di-generate!');
            } else {
                echo "Gagal menyimpan QR untuk: $dt->data_nama\n";
                \Log::error('File: ' . $qrImageName . ' gagal di-save...');
            }
        }
        echo "BERHASIL GENERATE QR!";
    }

    public function test_qr()
    {
        return view("testqr");
    }

    public function isAes256EncryptedJson($input)
    {
        if (preg_match('/^[a-zA-Z0-9\/\+=]*$/', $input)) {
            $decoded = base64_decode($input, true);
            if ($decoded !== false) {
                $jsonData = json_decode($decoded, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    return true;
                }
            }
        }
        return false;
    }

    public function proses_test_qr(Request $request)
    {
        $data = Data::find(184);
        $qr_request = $request->qr;
        if ($this->isAes256EncryptedJson($qr_request)) {
            $decryptedData = Crypt::decryptString($qr_request);
            $exploding_sun = explode("#", $decryptedData);
            if($data->data_nama == $exploding_sun[0] || $data->data_no_id_card == $exploding_sun[1]) {
                echo "HORE KAMU BISA MAKAN!";
            } else {
                echo "TIDAK BISA MAKAN!";
            }
        } else {
            echo "Maaf jangan input sembarangan bos!";
        }
    }

    public function generateUniqueDataId()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $uniqueId = '';
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $uniqueId .= $characters[$index];
        }
        while (Data::where('data_unique_id', $uniqueId)->exists()) {
            $uniqueId = $this->generateUniqueDataId(); // Rekursif untuk membuat yang baru
        }
        return $uniqueId;
    }

    public function generate_unique_id()
    {
        $dataRecords = Data::whereNull('data_unique_id')->get();
        foreach ($dataRecords as $record) {
            $record->data_unique_id = strtoupper($this->generateUniqueDataId());
            $record->save();
        }
    }
}
