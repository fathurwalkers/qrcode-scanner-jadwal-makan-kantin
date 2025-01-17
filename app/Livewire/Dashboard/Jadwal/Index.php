<?php

namespace App\Livewire\Dashboard\Jadwal;

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
    public $title = 'Jadwal';
    public $jadwal;

    public function mount()
    {
        $this->jadwal = Jadwal::latest()->get();
    }

    public function render()
    {
        return view('livewire.dashboard.jadwal.index')
            ->layout('layouts.dashboard-layout', [
                'title' => $this->title,
            ]);
    }

    public function layoutData()
    {
        return [
            'title' => $this->title,
        ];
    }
}
