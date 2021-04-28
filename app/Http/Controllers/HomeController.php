<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Consumo;
use App\Models\Empresa;
use App\Models\Envio;
use App\Models\Estoque_ave;
use App\Models\Estoque_ovo;
use App\Models\Geraltarefa;
use App\Models\Lote;
use App\Models\Mortalidade;
use App\Models\Periodo;
use App\Models\Semana;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // KPI Home
        $lotes = Lote::get();
        $aviarios = Aviario::get();
        $coletas = Coleta::get();
        $mortalidades = Mortalidade::get();
        $consumos = Consumo::get();
        $lotesperiodo = Lote::where('periodo', Periodo::ativo())->get();
        $semanaatual = Semana::where('data_inicial', '<=', Carbon::now())->where('data_final', '>=', Carbon::now())->first();

        $producao = Coleta::where('data_coleta', '>=', $semanaatual->data_inicial)->where('data_coleta', '<=', $semanaatual->data_final)->get();
        // Intervalo de datas da semana
        $periodos = new DatePeriod(new DateTime($semanaatual->data_inicial), new DateInterval('P1D'), new DateTime($semanaatual->data_final));

        // Remove division by zero
        $capitalizadas = $lotesperiodo->sum->femea_capitalizada ? $lotesperiodo->sum->femea_capitalizada : 1;
        // Datas da semana do gráfico
        foreach ($periodos as $period) :
            $datasemana[] = $period->format('d/m/Y');
        endforeach;
        //Produção da semana por dia gráfico
        foreach ($periodos as $periodo) :
            $posturadia = Coleta::where('data_coleta', $periodo->format('Y-m-d'))->sum('postura_dia');
            $producaosemana[] = number_format(($posturadia / $capitalizadas) * 100, 2, '.', '');
        endforeach;
        // Média de produção semanal
        $media = number_format((($producao->sum->postura_dia / 7) / $capitalizadas) * 100, 2, '.', '');
        // Produção alcançada na semana
        $alcancada = number_format(($producao->sum->postura_dia / $capitalizadas) * 100, 2, '.', '');

        // Estoque de ovos
        $estoqueovos = Estoque_ovo::where('periodo', Periodo::ativo())->get();
        // Estoque aves
        $estoqueaves = Estoque_ave::where('periodo', Periodo::ativo())->get();
        // Tarefas gerais
        $tarefas = Geraltarefa::where('periodo', Periodo::ativo())->get();

        $segmento = Empresa::first();

        return view('home.index', compact('segmento', 'lotes', 'aviarios', 'coletas', 'mortalidades', 'consumos', 'semanaatual', 'datasemana', 'producaosemana', 'media', 'alcancada', 'estoqueovos', 'estoqueaves', 'tarefas', 'capitalizadas'));
    }
}
