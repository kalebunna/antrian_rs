<?php

namespace App\Http\Controllers;

use App\Models\resepsionis;
use Illuminate\Http\Request;

class ResepsionisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resepsionis = resepsionis::get();
        return view('resepsionis.index', compact('resepsionis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        resepsionis::create(
            $request->all()
        );
        return response()->json("success", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(resepsionis $resepsionis)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(resepsionis $resepsionis)
    {
        return view('resepsionis.update', compact('resepsionis'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, resepsionis $resepsionis)
    {
        $resepsionis->update($request->all());
        return redirect()->route('resepsionis.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(resepsionis $resepsionis)
    {
        try {
            $resepsionis->delete();
            return response()->json("success", 200);
        } catch (\Throwable $th) {
            return response()->json("err", 404);
        }
    }
}
