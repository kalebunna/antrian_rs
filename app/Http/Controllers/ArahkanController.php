<?php

namespace App\Http\Controllers;

use App\Models\Arahkan;
use App\Models\poli;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;

use function PHPUnit\Framework\isNull;

class ArahkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store($id_poli, $id_antrian)
    {
        $no_antri = Arahkan::whereDate('tanggal', Carbon::today())->count();
        $kode_antri = poli::where('id', $id_poli)->first();
        Arahkan::create([
            "antrian_id" => $id_antrian,
            "poli_id" => $id_poli,
            "no_antrian" => $this->generateNumber($kode_antri->kode_antrian, $no_antri += 1),
            "status" => 0,
            "active" => false,
            "tanggal" => Carbon::now()
        ]);

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

    public function getAtrianForCalling(Request $request, $id_poli)
    {
        // dd($id_poli);
        if ($request->ajax()) {
            $data = Arahkan::where('status', '0')->where('poli_id', $id_poli)->with('antrian')->orderBy('no_antrian', 'asc')->get();
            return Datatables::of($data)
                ->addColumn('kategori', function ($row) {
                    if ($row->antrian->prioritas == 1) {
                        return "prioritas";
                    } else {
                        return "umum";
                    }
                })
                ->addColumn('jenisKategori', function ($row) {
                    return $row->antrian->jenis_prioritas;
                })
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function getLastArahkan($id)
    {

        $data = Arahkan::where('status', '0')->where('poli_id', $id)->orderBy('no_antrian', 'asc')->first();
        if ($data != null) {
            Arahkan::where('active', true)->where('poli_id', $id)->whereDate('tanggal', Carbon::today())->update([
                "active" => false
            ]);
            $data->update([
                "status" => "1",
                "active" => true
            ]);
            return response()->json($data, 200);
        } else {
            return response()->json("kosong", 200);
        }
    }

    function panggil_ulang($data)
    {
        $antrian = Arahkan::where('id', $data)->first();
        $antrian->increment('status', 1);
        // $antrian->incement('status', $inc);
        return response()->json($antrian, 200);
    }
}
