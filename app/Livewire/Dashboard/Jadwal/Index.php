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
    public function render()
    {
        return view('livewire.dashboard.jadwal.index', [
            'jadwal' => Jadwal::latest('updated_at')->paginate(5),
        ])
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
