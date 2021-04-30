<?php

use App\Http\Controllers\AviarioController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\ColetaController;
use App\Http\Controllers\ConsumoController;
use App\Http\Controllers\ControlediarioController;
use App\Http\Controllers\DespesaController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EnvioController;
use App\Http\Controllers\FinanceiroController;
use App\Http\Controllers\GeraltarefaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\MetaController;
use App\Http\Controllers\MortalidadeController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\PesagemController;
use App\Http\Controllers\RecebimentoController;
use App\Http\Controllers\RelatorioController;
use Illuminate\Support\Facades\Auth;
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

    Route::prefix('periodos')->name('periodos.')->group(function () {
        Route::post('addsemanasperiodo', [PeriodoController::class, 'addsemanasperiodo'])->name('addsemanasperiodo');
        Route::post('ativaperiodo', [PeriodoController::class, 'ativaperiodo'])->name('ativaperiodo');
        Route::post('busca', [PeriodoController::class, 'busca'])->name('busca');
    });
    Route::resource('periodos', PeriodoController::class);

    Route::prefix('lotes')->name('lotes.')->group(function () {
        Route::post('showcapitalizada', [LoteController::class, 'showcapitalizada'])->name('showcapitalizada');
        Route::post('capitalizar', [LoteController::class, 'capitalizar'])->name('capitalizar');
        Route::post('busca', [LoteController::class, 'busca'])->name('busca');
        Route::post('checklote', [LoteController::class, 'checklote'])->name('checklote');
        Route::post('checkuplote', [LoteController::class, 'checkuplote'])->name('checkuplote');
    });
    Route::resource('lotes', LoteController::class);

    Route::prefix('aviarios')->name('aviarios.')->group(function () {
        Route::post('busca', [AviarioController::class, 'busca'])->name('busca');
        Route::post('autocomplete', [AviarioController::class, 'autocomplete'])->name('autocomplete');
        Route::post('aveslote', [AviarioController::class, 'aveslote'])->name('aveslote');
        Route::post('aviarioslote', [AviarioController::class, 'aviarioslote'])->name('aviarioslote');
    });
    Route::resource('aviarios', AviarioController::class);

    Route::prefix('coletas')->name('coletas.')->group(function () {
        Route::post('busca', [ColetaController::class, 'busca'])->name('busca');
        Route::post('numcoleta', [ColetaController::class, 'numcoleta'])->name('numcoleta');
    });
    Route::resource('coletas', ColetaController::class);

    Route::prefix('envios')->name('envios.')->group(function () {
        Route::post('busca', [EnvioController::class, 'busca'])->name('busca');
        Route::post('ovoslote', [EnvioController::class, 'ovoslote'])->name('ovoslote');
    });
    Route::resource('envios', EnvioController::class);

    Route::prefix('mortalidades')->name('mortalidades.')->group(function () {
        Route::post('busca', [MortalidadeController::class, 'busca'])->name('busca');
    });
    Route::resource('mortalidades', MortalidadeController::class);

    Route::prefix('pesagens')->name('pesagens.')->group(function () {
        Route::post('busca', [PesagemController::class, 'busca'])->name('busca');
    });
    Route::resource('pesagens', PesagemController::class)->parameters(['pesagens' => 'pesagem']);

    Route::prefix('recebimentos')->name('recebimentos.')->group(function () {
        Route::post('busca', [RecebimentoController::class, 'busca'])->name('busca');
    });
    Route::resource('recebimentos', RecebimentoController::class);

    Route::prefix('consumos')->name('consumos.')->group(function () {
        Route::post('busca', [ConsumoController::class, 'busca'])->name('busca');
    });
    Route::resource('consumos', ConsumoController::class);

    Route::prefix('geraltarefas')->name('geraltarefas.')->group(function () {
        Route::post('busca', [GeraltarefaController::class, 'busca'])->name('busca');
    });
    Route::resource('geraltarefas', GeraltarefaController::class);

    Route::prefix('controlediarios')->name('controlediarios.')->group(function () {
        Route::post('busca', [ControlediarioController::class, 'busca'])->name('busca');
        Route::post('verificacontrole', [ControlediarioController::class, 'verificacontrole'])->name('verificacontrole');
        Route::post('editacontrole', [ControlediarioController::class, 'editacontrole'])->name('editacontrole');
    });
    Route::resource('controlediarios', ControlediarioController::class);

    Route::prefix('despesas')->name('despesas.')->group(function () {
        Route::post('busca', [DespesaController::class, 'busca'])->name('busca');
    });
    Route::resource('despesas', DespesaController::class);

    Route::resource('financeiros', FinanceiroController::class);

    Route::prefix('metas')->name('metas.')->group(function () {
        Route::get('eclosao', [MetaController::class, 'eclosao'])->name('eclosao');
        Route::get('fertilidade', [MetaController::class, 'fertilidade'])->name('fertilidade');
        Route::get('producao', [MetaController::class, 'producao'])->name('producao');
        Route::post('updatemeta', [MetaController::class, 'updatemeta'])->name('updatemeta');
    });

    Route::prefix('empresas')->name('empresas.')->group(function () {
        Route::post('delimagem', [EmpresaController::class, 'delimagem'])->name('delimagem');
    });
    Route::resource('empresas', EmpresaController::class);

    Route::resource('emails', EmailController::class);

    Route::prefix('backups')->name('backups.')->group(function () {
        Route::get('gerabackup', [BackupController::class, 'gerabackup'])->name('gerabackup');
        Route::get('executabackup', [BackupController::class, 'executabackup'])->name('executabackup');
    });
    Route::resource('backups', BackupController::class);

    Route::prefix('relatorios')->name('relatorios.')->group(function () {
        Route::get('movimentodiario', [RelatorioController::class, 'movimentodiario'])->name('movimentodiario');
        Route::post('pdfmovimentodiario', [RelatorioController::class, 'pdfmovimentodiario'])->name('pdfmovimentodiario');
        Route::post('enviarelatorio', [RelatorioController::class, 'enviarelatorio'])->name('enviarelatorio');
        Route::get('coleta', [RelatorioController::class, 'coleta'])->name('coleta');
        Route::post('pdfcoleta', [RelatorioController::class, 'pdfcoleta'])->name('pdfcoleta');
        Route::get('financeiro', [RelatorioController::class, 'financeiro'])->name('financeiro');
        Route::post('pdffinanceiro', [RelatorioController::class, 'pdffinanceiro'])->name('pdffinanceiro');
        Route::get('estoqueave', [RelatorioController::class, 'estoqueave'])->name('estoqueave');
        Route::post('pdfestoqueave', [RelatorioController::class, 'pdfestoqueave'])->name('pdfestoqueave');
        Route::get('estoqueovo', [RelatorioController::class, 'estoqueovo'])->name('estoqueovo');
        Route::post('pdfestoqueovo', [RelatorioController::class, 'pdfestoqueovo'])->name('pdfestoqueovo');
    });

Auth::routes();
