<?php

namespace App\Http\Controllers;

use App\Models\LogPanggilan;
use Illuminate\Http\Request;

class LogPanggilanController extends Controller
{
    function index(Request $request)
    {
        if ($request->ajax()) {
            $log = LogPanggilan::orderBy('id', 'ASC')->get();

            return response()->json($log, 200);
        }
        return view('LogPanggilan.index');
    }

    function destroy($id)
    {
        $log = LogPanggilan::where('id', $id)->firstOrFail();
        $log->delete();
    }

    function store(Request $request)
    {
        LogPanggilan::create($request->all());
    }
}
