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

    public function render()
    {
        return view('livewire.dashboard.karyawan.index', [
            'karyawan' => Data::latest('updated_at')->paginate(10),
        ])->layout('layouts.dashboard-layout', [
            'title' => $this->title,
        ]);
    }
}
