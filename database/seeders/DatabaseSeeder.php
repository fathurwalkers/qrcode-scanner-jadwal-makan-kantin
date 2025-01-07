<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use App\Models\Login;
use App\Models\Data;
use App\Models\Jadwal;
use App\Models\Periode;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // =================================================================================================
        // =================================================================================================
        // Generate Data Periode
        // $tahun_periode = "2024";
        // $array_bulan = [
        //     'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        // ];
        // $iter = 1;

        // foreach ($array_bulan as $rr) {
        //     $periode = new Periode;
        //     $save_divisi = $periode->create([
        //         'periode_bulan_int' => $iter++,
        //         'periode_tahun' => $tahun_periode,
        //         'periode_bulan' => $rr,
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ]);
        //     $save_divisi->save();
        // }

        $tahun_periode = "2025";
        $array_bulan = [
            'Januari', 'Februari',
            'Maret', 'April',
            'Mei', 'Juni',
            'Juli', 'Agustus',
            'September', 'Oktober',
            'November', 'Desember'
        ];
        $iter = 1;

        foreach ($array_bulan as $rr) {
            $periode = new Periode;
            $save_divisi = $periode->create([
                'periode_bulan_int' => $iter++,
                'periode_tahun' => $tahun_periode,
                'periode_bulan' => $rr,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $save_divisi->save();
        }

        // =================================================================================================
        // =================================================================================================

        // ADMIN
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

        // ADMIN 1
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
        // ---------------------------------------------------------------------------
    }
}
