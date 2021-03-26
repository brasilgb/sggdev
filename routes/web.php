<?php

use App\Http\Controllers\AviarioController;
use App\Http\Controllers\ColetaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\PeriodoController;
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
Route::post('periodos/addsemanasperiodo', [PeriodoController::class, 'addsemanasperiodo'])->name('periodos.addsemanasperiodo');
Route::post('periodos/ativaperiodo', [PeriodoController::class, 'ativaperiodo'])->name('periodos.ativaperiodo');
Route::post('periodos/busca', [PeriodoController::class, 'busca'])->name('periodos.busca');

Route::resource('lotes', LoteController::class);
Route::post('lotes/showcapitalizada', [LoteController::class, 'showcapitalizada'])->name('lotes.showcapitalizada');
Route::post('lotes/capitalizar', [LoteController::class, 'capitalizar'])->name('lotes.capitalizar');
Route::post('lotes/busca', [LoteController::class, 'busca'])->name('lotes.busca');
Route::post('lotes/checklote', [LoteController::class, 'checklote'])->name('lotes.checklote');
Route::post('lotes/checkuplote', [LoteController::class, 'checkuplote'])->name('lotes.checkuplote');

Route::resource('aviarios', AviarioController::class);
Route::post('aviarios/busca', [AviarioController::class, 'busca'])->name('aviarios.busca');
Route::post('aviarios/autocomplete', [AviarioController::class, 'autocomplete'])->name('aviarios.autocomplete');
Route::post('aviarios/aviarioslote', [AviarioController::class, 'aviarioslote'])->name('aviarios.aviarioslote');

Route::resource('coletas', ColetaController::class);
Route::post('coletas/busca', [ColetaController::class, 'busca'])->name('coletas.busca');
