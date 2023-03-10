<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TunggakanController;
use App\Http\Controllers\EntryPembayaranController;
use App\Http\Controllers\HistorySiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\LoginController;
use Dompdf\Dompdf;
use App\Models\Pembayaran;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'authanticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/test', function () {
    return view('dashboard.tunggakan.index');
});

Route::middleware('login')->group(function () {

    // all access
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    });
    Route::get('dataHistory', [PembayaranController::class, 'history']);

    // admin
    Route::resource('dataKelas', KelasController::class)->middleware('admin');
    Route::resource('dataPetugas', PetugasController::class)->middleware('admin');
    Route::resource('dataSiswa', SiswaController::class)->middleware('admin');
    Route::resource('dataPembayaran', PembayaranController::class)->middleware('admin');
    Route::resource('dataSpp', SppController::class)->middleware('admin');
    Route::resource('dataTunggakan', TunggakanController::class)->middleware('admin');

    Route::get('/generateLaporan', function () {
        $history = Pembayaran::all();
        $dompdf = new Dompdf();
        $html = view('dashboard.pembayaran.pdf', compact('history'))->render();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        return $dompdf->stream('Laporan Pembayaran.pdf');
    })->middleware('admin');

    Route::get('/dataKelas/search', [KelasController::class, 'search'])->middleware('admin');
    Route::get('/dataTunggakan/search', [TunggakanController::class, 'search'])->middleware('admin');
    Route::get('/dataPembayaran/search', [PembayaranController::class, 'search'])->middleware('admin');
    Route::get('/dataHistory/search', [PembayaranController::class, 'search2'])->middleware('admin');
    Route::get('/dataPetugas/search', [PetugasController::class, 'search'])->middleware('admin');
    Route::get('/dataSiswa/search', [SiswaController::class, 'search'])->middleware('admin');
    Route::get('/dataSpp/search', [SppController::class, 'search'])->middleware('admin');

    // petugas
    Route::resource('entryPembayaran', EntryPembayaranController::class)->middleware('petugas');

    Route::get('/entryPembayaran/search', [EntryPembayaranController::class, 'search'])->middleware('petugas');
    Route::get('/dataHistory/search', [PembayaranController::class, 'search2'])->middleware('petugas');
    
    // siswa
    Route::resource('historyPembayaran', HistorySiswaController::class)->middleware('siswa');
    Route::get('/historyPembayaran/search', [HistorySiswaController::class, 'search'])->middleware('siswa');
});