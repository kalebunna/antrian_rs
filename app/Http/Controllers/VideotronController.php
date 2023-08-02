<?php

namespace App\Http\Controllers;

use App\Models\antrian;
use App\Models\antrian_resepsionis_status;
use App\Models\Arahkan;
use App\Models\poli;
use App\Models\resepsionis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VideotronController extends Controller
{
    function index()
    {
        $resepsioniss = resepsionis::where('status', true)->get();
        $poli = poli::where('status', true)->get();
        return view('videtron.index', compact('resepsioniss', 'poli'));
    }

    function getAntrianActive($id)
    {
        $data = antrian_resepsionis_status::with('antrian')->where('status', true)->where('resepsionis_id', $id)->first();
        return response()->json(["status" => "success", "data" => $data], 200);
    }

    function getArahkanActive($id)
    {
        $data = Arahkan::where('active', true)->where('poli_id', $id)->whereDate('tanggal', Carbon::today())->first();
        return response()->json(["status" => "success", "data" => $data], 200);
    }
}
