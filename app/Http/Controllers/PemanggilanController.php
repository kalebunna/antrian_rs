<?php

namespace App\Http\Controllers;

use App\Models\poli;
use App\Models\resepsionis;
use Illuminate\Http\Request;
use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;

class PemanggilanController extends Controller
{
    function panggilPendaftaran()
    {
        $lokets = resepsionis::get();
        $polis = poli::get();
        return view('pemanggilan.pendaftaran', compact('lokets', 'polis'));
    }

    function panggilPoli()
    {
        $polis = poli::get();
        return view('pemanggilan.panggilPoli', compact('polis'));
    }
}
