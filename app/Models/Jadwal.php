<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Periode;
use App\Models\Data;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = "jadwal";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function data()
    {
        return $this->belongsTo(Data::class);
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
