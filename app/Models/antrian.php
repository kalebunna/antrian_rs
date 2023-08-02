<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class antrian extends Model
{
    use HasFactory;

    protected $fillable = [
        "no_antrian",
        "prioritas",
        "tanggal",
        "jenis_prioritas",
        'status',
    ];

    /**
     * Get the arahkan associated with the antrian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function arahkan()
    {
        return $this->hasOne(arahkan::class);
    }

    /**
     * Get the user associated with the antrian
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function antrian_resepsionis_status()
    {
        return $this->hasOne(antrian_resepsionis_status::class);
    }
}
