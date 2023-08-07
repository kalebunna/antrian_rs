<?php

namespace App\Http\Controllers;

use App\Events\dataAntrianEvent;
use App\Models\antrian;
use App\Models\antrian_resepsionis_status;
use App\Models\identitas;
use App\Models\TokenAntrian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use function PHPUnit\Framework\isNull;

class AntrianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $identitas = identitas::first();
        $token = TokenAntrian::firstOrCreate(['status' => false], [
            "token" => Carbon::now()->format('hisdmy') . rand(0, 9999),
            "status" => false
        ]);
        return view('utama.cetak', compact('identitas', 'token'));
    }

    function create($jenis, $token, $detail = null)
    {
        $cekToken = TokenAntrian::where('token', $token)->first();
        if ($cekToken) {
            if (!$cekToken->status) {
                switch ($jenis) {
                    case 'prioritas':
                        $no_antri = antrian::whereDate('tanggal', Carbon::today())->count();
                        antrian::create([
                            "no_antrian" => "A " . $no_antri += 1,
                            "prioritas" => 1,
                            'status' => "0",
                            'jenis_prioritas' => $detail,
                            "tanggal" => Carbon::now(),
                        ]);
                        $cekToken->update([
                            "status" => true
                        ]);
                        break;
                    default:
                        $no_antri = antrian::whereDate('tanggal', Carbon::today())->count();
                        antrian::create([
                            "no_antrian" => "A " . $no_antri += 1,
                            "prioritas" => 0,
                            "status" => "0",
                            "tanggal" => Carbon::now()
                        ]);
                        $cekToken->update([
                            "status" => true
                        ]);
                        break;
                }
            } else {
                return redirect()->back()->with('key', 'Mohon Cetak Ulang Kartu');
            }
        }

        return redirect()->back()->with('key', 'Mohon Cetak Ulang Kartu');
    }


    public function getAtrianForCalling(Request $request, $prioritas)
    {
        if ($request->ajax()) {
            $data = antrian::where('status', '0')->whereDate('tanggal', Carbon::today())->where('prioritas', $prioritas)->orderBy('no_antrian', 'asc')->get();
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


    public function getLastAntrian($id_resepsionis, $prioritas)
    {

        $data = antrian::where('status', '0')->where('prioritas', $prioritas)->orderBy('no_antrian', 'asc')->whereDate('tanggal', Carbon::today())->first();
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


    function panggil_ulang(Request $request, $data)
    {
        if ($request->ajax()) {
            $antrian = antrian::with('antrian_resepsionis_status')->where('id', $data)->first();
            $antrian->increment('status', 1);
            $id_resepsionis = $antrian->antrian_resepsionis_status->resepsionis_id;
            antrian_resepsionis_status::where('resepsionis_id', $id_resepsionis)
                ->whereDate('created_at', Carbon::now())
                ->where('status', true)
                ->update([
                    'status' => false
                ]);
            $antrian->antrian_resepsionis_status()->update([
                "status" => true
            ]);
            return response()->json($antrian, 200);
        } else {

            abort(404);
        }
    }

    function getAllData(Request $request)
    {
        if ($request->ajax()) {
            $data = antrian::whereDate('tanggal', Carbon::today())->orderBy('no_antrian', 'desc')->get();
            return Datatables::of($data)
                ->addColumn('kategori', function ($row) {
                    if ($row->prioritas == 1) {
                        return "prioritas";
                    } else {
                        return "umum";
                        # code...
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<button class="btn btn-primary w-100" onclick="perbaruiAntrian(' . $row->id . ')">Pilih</button>';
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }
    function tes_printer($noANtrian, $kategori)
    {
        $nama = showIdentitas()->nama;
        $alamamat = showIdentitas()->alamat;

        setlocale(LC_ALL, 'IND');
        $date = Carbon::parse(Carbon::now())->locale('id');
        $date->settings(['formatFunction' => 'translatedFormat']);
        $tanggal = $date->format('l, j F Y ; h:i a');

        try {
            $connector = new WindowsPrintConnector("80 Printer");
            $printer = new Printer($connector);
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
            $printer->text($nama . "\n");
            $printer->selectPrintMode(Printer::MODE_FONT_A);
            $printer->text($alamamat . "\n\n");
            $printer->text("___________________________________________" . "\n\n");

            $printer->text("Antrian Pendaftaran");

            $printer->selectPrintMode(Printer::MODE_FONT_B);
            $printer->selectPrintMode(Printer::MODE_UNDERLINE);
            $printer->text("\n .$kategori. \n");
            $printer->setTextSize(8, 8);
            $printer->text($noANtrian);
            $printer->selectPrintMode(Printer::MODE_FONT_A);

            $printer->text("\n___________________________________________" . "\n\n");

            $printer->text("Terimakasih Semoga Sehat Selalu" . "\n");

            $printer->text($tanggal . "\n");
            $printer->cut();

            $printer->close();
        } catch (Exception $e) {
            echo "Couldn't print to this printer: " . $e->getMessage() . "\n";
        }
    }

    function getAntrianByid(antrian $antrian)
    {
        $antrian->update(
            ["status" => 0]
        );
        return response()->json($antrian, 200);
    }
}
