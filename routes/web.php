<?php

use App\Events\dataAntrianEvent;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\ArahkanController;
use App\Http\Controllers\IdentitasController;
use App\Http\Controllers\LogPanggilanController;
use App\Http\Controllers\PemanggilanController;
use App\Http\Controllers\PoliController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResepsionisController;
use App\Http\Controllers\VideotronController;
use App\Models\resepsionis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::resource('identitas', IdentitasController::class)->except('show', 'update', 'store', 'destroy', 'create', 'edit');
Route::post('identitas/{identitas}', [IdentitasController::class, 'update'])->name('identitas.update');
Route::get('antrian', [AntrianController::class, 'index'])->name('antrian.index');
Route::get('antrian/{jenis}', [AntrianController::class, 'create'])->name('antrian.create');
Route::get('resepsionis',  [ResepsionisController::class, 'index'])->name('resepsionis.index');
Route::post('resepsionis', [ResepsionisController::class, 'store'])->name('resepsionis.store');
Route::delete('resepsionis/{resepsionis}', [ResepsionisController::class, 'destroy'])->name('resepsionis.destroy');
Route::resource('resepsionis', ResepsionisController::class)->parameters([
    "resepsionis" => "resepsionis"
]);

route::get('pendaftaran', [PemanggilanController::class, 'panggilPendaftaran'])->name('pendaftaran');
route::get('panggilpoli', [PemanggilanController::class, 'panggilPoli'])->name('panggilPoli');
route::get('getAntrian', [AntrianController::class, 'getAtrianForCalling'])->name('getAntrian');
route::get('getLasAntrian/{id}', [AntrianController::class, 'getLastAntrian'])->name('getLastAntrian');
Route::get('antrian/panggilulang/{antrian}', [AntrianController::class, 'panggil_ulang'])->name('antrian.panggil_ulang');
Route::get('arahkan/panggilulang/{antrian}', [ArahkanController::class, 'panggil_ulang'])->name('arahkan.panggil_ulang');

route::get('getArahkan/{id}', [ArahkanController::class, 'getAtrianForCalling'])->name('getArahkan');
route::get('getLasArahkan/{id}', [ArahkanController::class, 'getLastArahkan'])->name('getLastArahkan');

route::get('textTovoice', [PemanggilanController::class, 'textToVoice'])->name('textToVoice');

Route::get('logpanggilan', [LogPanggilanController::class, 'index'])->name('logPanggilan.index');
Route::post('logpanggilan', [LogPanggilanController::class, 'store'])->name('logPanggilan.store');
Route::get('logpanggilan/{id}', [LogPanggilanController::class, 'destroy'])->name('logPanggilan.destroy');


Route::resource('poli', PoliController::class);
Route::get('arahkan/{id_poli}/antrian/{antrian}', [ArahkanController::class, 'store'])->name('arahkan.store');

Route::get('videotron', [VideotronController::class, 'index'])->name('videtron');
Route::get('videotron/antrian/{id}', [VideotronController::class, 'getAntrianActive'])->name('videotron.antrian');
Route::get('videotron/arahkan/{id}', [VideotronController::class, 'getArahkanActive'])->name('videotron.arahkan');

// Route::resource('arahkan', ArahkanController::class);
Route::get('tes', function () {
    broadcast(new dataAntrianEvent());
});


Route::get('anu', function () {
    return view('welcome');
});
