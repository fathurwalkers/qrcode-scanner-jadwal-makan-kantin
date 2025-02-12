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
        $blocks = preg_split("//", $content);
        foreach ($blocks as $block) {
            preg_match("/NIK\s+:\s+(\d+)/", $block, $nik);
            preg_match("/Nama\s+:\s+(.+)/", $block, $nama);
            preg_match("/(\d{2}\/\d{2}\/\d{4})\s+\w+\s+([\d:]+)?\s+([\d:]+)?\s+([\d:]+)?\s+([\d:]+)?/", $block, $waktu);
            $fixTime = function ($time) {
                if (!$time) return null;
                $parts = explode(':', $time);
                if (count($parts) === 2) {
                    $hour = str_pad($parts[0], 2, "0", STR_PAD_LEFT);
                    return "{$hour}:{$parts[1]}:00";
                }
                return null;
            };
            $data[] = [
                'nik' => $nik[1] ?? null,
                'nama' => trim($nama[1] ?? ''),
                'jadwal_tanggal' => isset($waktu[1]) ? Carbon::createFromFormat('d/m/Y', $waktu[1])->toDateString() : null,
                'jadwal_pagi' => isset($waktu[2]) ? $fixTime($waktu[2]) : null,
                'jadwal_siang' => isset($waktu[3]) ? $fixTime($waktu[3]) : null,
                'jadwal_malam' => isset($waktu[4]) ? $fixTime($waktu[4]) : null,
                'jadwal_subuh' => isset($waktu[5]) ? $fixTime($waktu[5]) : null,
            ];
        }
        return $data;
    }
}
