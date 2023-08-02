<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antrian_resepsionis_status extends Model
{
    use HasFactory;
    protected $fillable = [
        "antrian_id",
        "resepsionis_id",
        "status"
    ];

    public function antrian()
    {
        return $this->belongsTo(antrian::class);
    }
}
