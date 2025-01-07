<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Login;
use App\Models\Jadwal;

class Data extends Model
{
    use HasFactory;
    protected $table = "data";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function login()
    {
        return $this->hasMany(Login::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
