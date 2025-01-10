<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Index extends Component
{
    public $nama = "Karyawan bin Karyawan K. Karyawan";
    public $subuh = "TIDAK";
    public $pagi = "YA";
    public $siang = "TIDAK";
    public $malam = "YA";
    public $waktu_scan_subuh = "04:00";
    public $waktu_scan_pagi = "07:00";
    public $waktu_scan_siang = "11:00";
    public $waktu_scan_malam = "16:00";
    public $tanggalwaktu = "06/01/2025";

    #[Title('QR Scanner App - PT. KPA')]
    public function render()
    {
        return view('livewire.home.index');
    }
}
