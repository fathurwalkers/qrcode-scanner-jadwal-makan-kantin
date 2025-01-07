<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

class Periode extends Model
{
    use HasFactory;
    protected $table = "periode";
    protected $guarded = [];
    protected $primaryKey = "id";

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
