<?php

namespace App\Http\Controllers;

use App\Models\identitas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use ParagonIE\Sodium\File;

class IdentitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $identitas = identitas::first();
        return view('identitias.index', compact('identitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(identitas $identitas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(identitas $identitas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, identitas $identitas)
    {
        // dd($request->all());
        switch ($request->jenis) {
            case 'identitas':
                $identitas->update(
                    $request->all()
                );
                return redirect()->back()->with('stat', 'Identitas Berhasil di Perbarui');
                break;
            case 'logo':
                // $fileModel = new File;
                // $name = Carbon::now() . rand(0, 9999) . $request->file('logo')->getClientOriginalName();
                // $filePath = $request->file('logo')->storeAs('images', $name, 'public');
                $filenameWithExt = $request->file('logo')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('logo')->getClientOriginalExtension();
                $filenameSimpan = $filename . ' _ ' . time()  . '.' . $extension;
                $path = $request->file('logo')->storeAs('public/logo', $filenameSimpan);
                // dd($path);
                $identitas->update([
                    "logo" => $filenameSimpan
                ]);
                // dd($filePath);
                return redirect()->back()->with(' stat ', ' Identitas Berhasil di Pe  rba rui');
                break;
            case   'video':
                $filenameWithExt = $request->file('video')->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('video')->getClientOriginalExtension();
                $filenameSimpan = $filename . ' _ ' . time()  . '.' . $extension;
                $path = $request->file('video')->storeAs('public/video', $filenameSimpan);
                $identitas->update([
                    "video" => $filenameSimpan
                ]);

                return redirect()->back()->with('stat', 'Identitas Berhasil di Perbarui');
                break;
            default:
                abort(404);
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(identitas $identitas)
    {
        //
    }
}
