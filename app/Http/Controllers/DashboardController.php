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
        $content = str_replace("\r", "", $content);
        $blocks = preg_split("/(?:\f|\n\s*\n)/", $content);
        $vacancyData = null;
        foreach ($blocks as $block) {
            $block = preg_replace('/\s+/', ' ', trim($block));
            preg_match("/NIK\s+:\s+(\d+)/", $block, $nik);
            preg_match("/Nama\s+:\s+([A-Z\s]+)(?=\s+Outlet)/", $block, $nama);
            preg_match("/(\d{2}\/\d{2}\/\d{4})\s*(OFF)?\s*([0-9]{2}:[0-9]{2})?\s*([0-9]{2}:[0-9]{2})?\s*([0-9]{2}:[0-9]{2})?\s*([0-9]{2}:[0-9]{2})?/", $block, $waktu);
            $fixTime = function ($time) {
                if (!$time || trim($time) === '') return null;
                $parts = explode(':', trim($time));
                if (count($parts) === 2) {
                    $hour = str_pad($parts[0], 2, "0", STR_PAD_LEFT);
                    return "{$hour}:{$parts[1]}:00";
                }
                return null;
            };
            if (!empty($nik[1]) && !empty($nama[1])) {
                $entry = [
                    'nik' => $nik[1] ?? null,
                    'nama' => trim($nama[1] ?? ''),
                    'jadwal_tanggal' => isset($waktu[1]) ? Carbon::createFromFormat('d/m/Y', $waktu[1])->toDateString() : null,
                    'jadwal_pagi' => isset($waktu[2]) ? $fixTime($waktu[2]) : null,
                    'jadwal_siang' => isset($waktu[3]) ? $fixTime($waktu[3]) : null,
                    'jadwal_malam' => isset($waktu[4]) ? $fixTime($waktu[4]) : null,
                    'jadwal_subuh' => isset($waktu[5]) ? $fixTime($waktu[5]) : null,
                ];
                if (strtoupper($entry['nama']) === "VACANCY") {
                    $vacancyData = $entry;
                } else {
                    $data[] = $entry;
                }
            }
        }
        if ($vacancyData) {
            array_unshift($data, $vacancyData);
        }
        return $data;
    }

}
