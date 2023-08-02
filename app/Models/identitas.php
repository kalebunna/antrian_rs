<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class identitas extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama",
        "alamat",
        "logo",
        "video",
        "deskripsi"
    ];
}
