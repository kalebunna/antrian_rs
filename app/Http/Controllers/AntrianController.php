<?php

namespace App\Http\Controllers;

use App\Events\dataAntrianEvent;
use App\Models\antrian;
use App\Models\antrian_resepsionis_status;
use App\Models\identitas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

use function PHPUnit\Framework\isNull;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $identitas = identitas::first();
        return view('utama.cetak', compact('identitas'));
    }

    function create($jenis)
    {
        switch ($jenis) {
            case 'prioritas':
                $no_antri = antrian::whereDate('tanggal', Carbon::today())->count();
                antrian::create([
                    "no_antrian" => $this->generateNumber("A", $no_antri += 1),
                    "prioritas" => 1,
                    'status' => "0",
                    "tanggal" => Carbon::now(),
                ]);
                break;
            default:
                $no_antri = antrian::whereDate('tanggal', Carbon::today())->count();
                antrian::create([
                    "no_antrian" => $this->generateNumber("A", $no_antri += 1),
                    "prioritas" => 0,
                    "status" => "0",
                    "tanggal" => Carbon::now()
                ]);
                break;
        }

        return redirect()->back();
    }

    function generateNumber($prefix, $number)
    {
        $numDigits = strlen((string)$number);
        $zeroPadding = 3 - $numDigits;

        if ($zeroPadding > 0) {
            $zeros = str_repeat('0', $zeroPadding);
            return $prefix . $zeros . $number;
        }
        return $prefix . $number;
    }

    public function getAtrianForCalling(Request $request)
    {
        if ($request->ajax()) {
            $data = antrian::where('status', '0')->orderBy('prioritas', 'desc')->orderBy('no_antrian', 'asc')->get();
            return Datatables::of($data)
                ->addColumn('kategori', function ($row) {
                    if ($row->prioritas == 1) {
                        return "prioritas";
                    } else {
                        return "umum";
                        # code...
                    }
                })
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function getLastAntrian($id_resepsionis)
    {
        $data = antrian::where('status', '0')->orderBy('prioritas', 'desc')->orderBy('no_antrian', 'asc')->whereDate('tanggal', Carbon::today())->first();
        if ($data != null) {
            # code...
            antrian_resepsionis_status::where('resepsionis_id', $id_resepsionis)
                ->whereDate('created_at', Carbon::now())
                ->where('status', true)
                ->update([
                    'status' => false
                ]);
            $data->antrian_resepsionis_status()->create([
                "resepsionis_id" => $id_resepsionis,
                "antrian_id" => $data->id,
                "status" => true
            ]);
            $data->update([
                "status" => "1",
            ]);
            return response()->json($data, 200);
        } else {
            return response()->json("kosong", 200);
        }
    }

    function panggil_ulang($data)
    {
        $antrian = antrian::where('id', $data)->first();
        $antrian->increment('status', 1);
        // $antrian->incement('status', $inc);
        return response()->json($antrian, 200);
    }
}
