<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arahkan_poli_status extends Model
{
    use HasFactory;
    protected $fillable = [
        "poli_id",
        "arahkan_id",
        "status"
    ];
}
