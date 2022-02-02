<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPPDController;

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

Route::get('/home', function () {
    return redirect()->route('sppd');
});

Auth::routes();
Route::get('/', [SPPDController::class, 'index'])->name('index');
Route::get('/sppd', [SPPDController::class, 'indexSPPD'])->name('sppd');
Route::get('/ipa', [SPPDController::class, 'indexIPA'])->name('ipa');
Route::get('/ipa/detail/{id}', [SPPDController::class, 'detailIPA'])->name('ipa.detail');
Route::get('/pp', [SPPDController::class, 'indexPP'])->name('pp');
Route::get('/pp/detail/{id}', [SPPDController::class, 'detailPP'])->name('pp.detail');
Route::get('/sppd/add', [SPPDController::class, 'create'])->name('sppd.add');
Route::post('/sppd/add', [SPPDController::class, 'store'])->name('sppd.store');
Route::get('/sppd/edit/{id}', [SPPDController::class, 'edit'])->name('sppd.edit');
Route::get('/sppd/detil/{id}', [SPPDController::class, 'detilSPPD'])->name('sppd.detil');
Route::delete('/sppd/delete/{id}', [SPPDController::class, 'delete'])->name('sppd.delete');
Route::post('/sppd/update', [SPPDController::class, 'update'])->name('sppd.update');
Route::post('/sppd/updateStatus', [SPPDController::class, 'updateStatus'])->name('sppd.updateStatus');
Route::get('/sppd/filter/{filter}',[SPPDController::class, 'filterSPPD'])->name('sppd.filter');


Route::get('/ipa/detail/{id}/0',[SPPDController::class, 'dibuat2']);
Route::get('/ipa/detail/{id}/1',[SPPDController::class, 'diajukan2']);
Route::get('/ipa/detail/{id}/2',[SPPDController::class, 'disetujui2']);
Route::get('/ipa/detail/{id}/3',[SPPDController::class, 'finance2']);
Route::get('/ipa/detail/{id}/4',[SPPDController::class, 'selesai2']);
Route::get('/pp/detail/{id}/10',[SPPDController::class, 'ppdibuat2']);
Route::get('/pp/detail/{id}/11',[SPPDController::class, 'ppdiajukan2']);
Route::get('/pp/detail/{id}/12',[SPPDController::class, 'ppdisetujui2']);
Route::get('/pp/detail/{id}/13',[SPPDController::class, 'ppfinance2']);
Route::get('/pp/detail/{id}/14',[SPPDController::class, 'ppselesai2']);

Route::get('/detil/{id}/0',[SPPDController::class, 'dibuat']);
Route::get('/detil/{id}/1',[SPPDController::class, 'diajukan']);
Route::get('/detil/{id}/2',[SPPDController::class, 'disetujui']);
Route::get('/detil/{id}/3',[SPPDController::class, 'finance']);
Route::get('/detil/{id}/4',[SPPDController::class, 'selesai']);
Route::get('/detil/{id}/10',[SPPDController::class, 'ppdibuat']);
Route::get('/detil/{id}/11',[SPPDController::class, 'ppdiajukan']);
Route::get('/detil/{id}/12',[SPPDController::class, 'ppdisetujui']);
Route::get('/detil/{id}/13',[SPPDController::class, 'ppfinance']);
Route::get('/detil/{id}/14',[SPPDController::class, 'ppselesai']);