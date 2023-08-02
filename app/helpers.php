<?php

use App\Models\Identitas;

if (!function_exists('showIdentitas')) {
    function showIdentitas()
    {
        return Identitas::first();
    }
}
