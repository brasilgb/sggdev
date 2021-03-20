<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\Periodo\PeriodoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('periodos', PeriodoController::class);
Route::post('periodos/addsemanasperiodo', [PeriodoController::class, 'addsemanasperiodo'])->name('addsemanasperiodo');
Route::post('periodos/ativaperiodo', [PeriodoController::class, 'ativaperiodo'])->name('ativaperiodo');
Route::post('periodos/busca', [PeriodoController::class, 'busca'])->name('busca');

Route::resource('lotes', LoteController::class);
Route::post('lotes/sowcapitalizada', [LoteController::class, 'sowcapitalizada'])->name('sowcapitalizada');
Route::post('lotes/capitalizar', [LoteController::class, 'capitalizar'])->name('capitalizar');
Route::post('lotes/busca', [LoteController::class, 'busca'])->name('busca');
Route::post('lotes/checklote', [LoteController::class, 'checklote'])->name('checklote');
Route::post('lotes/checkuplote', [LoteController::class, 'checkuplote'])->name('checkuplote');
