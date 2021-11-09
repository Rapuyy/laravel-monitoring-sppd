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