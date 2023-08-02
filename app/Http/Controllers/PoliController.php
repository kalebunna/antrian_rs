<?php

namespace App\Http\Controllers;

use App\Models\poli;
use Illuminate\Http\Request;

class PoliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $polis = poli::get();
        return view('poli.index', compact('polis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('poli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        poli::create($request->all());
        return redirect()->route('poli.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(poli $poli)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(poli $poli)
    {
        return view('poli.edit', compact('poli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, poli $poli)
    {
        $poli->update($request->all());
        return redirect()->route('poli.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(poli $poli)
    {
        $poli->delete();
    }
}
