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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [SPPDController::class, 'index'])->name('sppd');
Route::get('/add', [SPPDController::class, 'create'])->name('sppd.add');
Route::post('/add', [SPPDController::class, 'store'])->name('sppd.store');
Route::get('/edit/{id}', [SPPDController::class, 'edit'])->name('sppd.edit');
Route::get('/detil/{id}', [SPPDController::class, 'detilSPPD'])->name('sppd.detil');
Route::delete('/delete/{id}', [SPPDController::class, 'delete'])->name('sppd.delete');
Route::post('/update', [SPPDController::class, 'update'])->name('sppd.update');
Route::post('/updateStatus', [SPPDController::class, 'updateStatus'])->name('sppd.updateStatus');
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