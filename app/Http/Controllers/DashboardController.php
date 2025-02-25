<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:txt|max:2048',
        ]);
        $path = $request->file('file')->move(public_path('assets/absensi-import'), $request->file('file')->getClientOriginalName());
        $content = file_get_contents($path);
        $parsedData = $this->parseAbsensi($content);
        dd($parsedData);
        foreach ($parsedData as $data) {
            Jadwal::updateOrCreate(
                ['nik' => $data['nik'], 'jadwal_tanggal' => $data['jadwal_tanggal']],
                $data
            );
        }
        return redirect()->back()->with('success', 'Data berhasil diimport!');
    }

    public function parseAbsensi($content)
    {
        $data = [];
        $content = str_replace("\r", "", $content);
        $blocks = preg_split("/\n\s*\n/", $content);
        foreach ($blocks as $block) {
            preg_match("/NIK\s+:\s+(\d+)/", $block, $nik);
            preg_match("/Nama\s+:\s+(.+)/", $block, $nama);
            preg_match("/(\d{2}\/\d{2}\/\d{4})\s+(\d{2}:\d{2})?\s+(\d{2}:\d{2})?\s+(\d{2}:\d{2})?\s+(\d{2}:\d{2})?/", $block, $waktu);
            $fixTime = function ($time) {
                if (!$time) return null;
                $parts = explode(':', $time);
                if (count($parts) === 2) {
                    $hour = str_pad($parts[0], 2, "0", STR_PAD_LEFT);
                    return "{$hour}:{$parts[1]}:00";
                }
                return null;
            };
            if (!empty($nik[1]) && !empty($waktu[1])) {
                $data[] = [
                    'nik' => $nik[1] ?? null,
                    'nama' => isset($nama[1]) ? trim($nama[1]) : null,
                    'jadwal_tanggal' => isset($waktu[1]) ? Carbon::createFromFormat('d/m/Y', $waktu[1])->toDateString() : null,
                    'jadwal_pagi' => isset($waktu[2]) ? $fixTime($waktu[2]) : null,
                    'jadwal_siang' => isset($waktu[3]) ? $fixTime($waktu[3]) : null,
                    'jadwal_malam' => isset($waktu[4]) ? $fixTime($waktu[4]) : null,
                    'jadwal_subuh' => isset($waktu[5]) ? $fixTime($waktu[5]) : null,
                ];
            }
        }
        return $data;
    }

    public function post_buat_user(Request $request)
    {
        $data = new Data;
        $qr_raw = strtoupper($request->data_nama) . "#" . strtoupper($request->data_no_id_card);
        $key = 'fathur-ganteng';
        $iv = random_bytes(16);
        $encrypted = openssl_encrypt($qr_raw, 'aes-256-cbc', $key, 0, $iv);
        $encryptedData = base64_encode($encrypted . '::' . base64_encode($iv));
        $save_data = $data->create([
            'data_nama' => strtoupper($request->data_nama),
            'data_no_id_card' =>  strtoupper($request->data_no_id_card),
            'data_divisi' =>  strtoupper($request->data_divisi),
            'data_dept' =>  strtoupper($request->data_dept),
            'data_jabatan' =>  strtoupper($request->data_jabatan),
            'data_kategori' => "KARYAWAN",
            'data_qr' => $encryptedData,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $save_data->save();
        $qr = QrCode::format('png')->size(500)
            ->eye('circle')
            ->color(0, 0, 0)
            ->margin(2)
            ->generate($save_data->data_qr);
        $qrImageName = $save_data->data_nama . ' - ' . '(' . $save_data->data_no_id_card . ')' . '.png';
        $qrPath = public_path('qr/' . $qrImageName);
        if (file_exists($qrPath)) {
            echo "File $qrImageName sudah ada, skip...\n <br />";
            \Log::info('File: ' . $qrImageName . ' sudah ada, skip...');
        }
        $saved = file_put_contents($qrPath, $qr);
        if ($saved) {
            echo "Berhasil generate QR untuk: $save_data->data_nama\n";
            \Log::info('File: ' . $qrImageName . ' berhasil di-generate!');
        } else {
            echo "Gagal menyimpan QR untuk: $save_data->data_nama\n";
            \Log::error('File: ' . $qrImageName . ' gagal di-save...');
        }
        echo "BERHASIL GENERATE QR!";
        return redirect()->route('dashboard-data-karyawan')->with('status', 'Berhasil Membuat Data Karyawan Baru!');
    }

    public function hapus_user(Request $request)
    {
        $user_id = intval($request->user_id);
        $user = Data::find($user_id);

        $filename = $user->data_nama . ' - (' . $user->data_no_id_card . ').png'; // Sesuaikan ekstensi file
        $filepath = public_path('qr/' . $filename);

        if (File::exists($filepath)) {
            echo "ADA!";
            File::delete($filepath);
        } else {
            echo "TIDAK ADA!";
        }
        // die;
        if ($user) {
            $user->delete();
            return redirect()->route('dashboard-data-karyawan')->with('status', 'Berhasil Menghapus Data Karyawan!');
        } else {
            return redirect()->route('dashboard-data-karyawan')->with('status', 'Gagal Menghapus Data Karyawan!');
        }
    }

    public function print_jadwal(Request $request)
    {
        $jadwal_tanggal = $request->jadwal_tanggal;
        $data = Data::orderByRaw("
            CASE
                WHEN data_divisi = 'HUMAN CAPITAL & GA' THEN 1
                WHEN data_divisi = 'PRODUKSI' THEN 2
                WHEN data_divisi = 'WAREHOUSE & ADMIN' THEN 3
                WHEN data_divisi = 'TANPA KETERANGAN' THEN 4
                WHEN data_divisi = 'OFFICE' THEN 5
                WHEN data_divisi = 'OPERASIONAL' THEN 6
                WHEN data_divisi IS NULL OR data_divisi = '' THEN 7
                ELSE 8
            END
        ")->get();
        $jadwal = Jadwal::where('jadwal_tanggal', $jadwal_tanggal)->get()->keyBy('data_id');
        $result = [];
        foreach ($data as $item) {
            $jadwalData = $jadwal[$item->id] ?? null;
            $result[] = [
                'data_nama' => $item->data_nama,
                'data_divisi' => $item->data_divisi,
                'data_jabatan' => $item->data_jabatan,
                'pagi' => $jadwalData->jadwal_cek_pagi ?? 'TIDAK',
                'pagi_scan' => isset($jadwalData->jadwal_jam_pagi) ? date('H:i:s', strtotime($jadwalData->jadwal_jam_pagi)) : NULL,
                'siang' => $jadwalData->jadwal_cek_siang ?? 'TIDAK',
                'siang_scan' => isset($jadwalData->jadwal_jam_siang) ? date('H:i:s', strtotime($jadwalData->jadwal_jam_siang)) : NULL,
                'malam' => $jadwalData->jadwal_cek_malam ?? 'TIDAK',
                'malam_scan' => isset($jadwalData->jadwal_jam_malam) ? date('H:i:s', strtotime($jadwalData->jadwal_jam_malam)) : NULL,
                'subuh' => $jadwalData->jadwal_cek_subuh ?? 'TIDAK',
                'subuh_scan' => isset($jadwalData->jadwal_jam_subuh) ? date('H:i:s', strtotime($jadwalData->jadwal_jam_subuh)) : NULL,
            ];
        }
        return view('livewire.dashboard.jadwal.print-jadwal', [
            'result' => $result,
            'tanggal' => $jadwal_tanggal,
        ]);
    }
}
