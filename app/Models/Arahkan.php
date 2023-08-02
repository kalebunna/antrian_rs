<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arahkan extends Model
{
    use HasFactory;
    protected $fillable = [
        'poli_id',
        'no_antrian',
        'antrian_id',
        'status',
        "tanggal",
        'active'
    ];
    public function antrian()
    {
        return $this->belongsTo(antrian::class);
    }
}
