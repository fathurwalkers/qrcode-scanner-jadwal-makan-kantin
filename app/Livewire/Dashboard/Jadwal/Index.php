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
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\LengthAwarePaginator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $title = 'Jadwal';
    public $tanggalFilter;

    public function updatingTanggalFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $jadwal = Jadwal::query();
        if (!empty($this->tanggalFilter)) {
            $jadwal->whereDate('jadwal_tanggal', $this->tanggalFilter);
        }
        $jadwal = $jadwal->latest('updated_at')->paginate(5);
        return view('livewire.dashboard.jadwal.index', [
            'jadwal' => $jadwal,
        ])->layout('layouts.dashboard-layout', [
            'title' => $this->title,
        ]);
    }
}
