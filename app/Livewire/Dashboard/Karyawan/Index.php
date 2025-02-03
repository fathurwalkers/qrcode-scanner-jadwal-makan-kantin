<?php

namespace App\Livewire\Dashboard\Karyawan;

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

    public $title = 'Data Karyawan';
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $searchTerm = strtoupper($this->search);
        $karyawan = Data::whereRaw("UPPER(data_nama) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("UPPER(data_no_id_card) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("UPPER(data_divisi) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("UPPER(data_dept) LIKE ?", ["%{$searchTerm}%"])
            ->orWhereRaw("UPPER(data_jabatan) LIKE ?", ["%{$searchTerm}%"])
            ->latest('updated_at')
            ->paginate(5);
        return view('livewire.dashboard.karyawan.index', [
            'karyawan' => $karyawan,
        ])->layout('layouts.dashboard-layout', [
            'title' => $this->title,
        ]);
    }
}
