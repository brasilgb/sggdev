<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Consumo;
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
        $lotes = Lote::count();
        $aviarios = Aviario::count();
        $coletas = Coleta::sum('postura_dia');
        $mortalidades = Mortalidade::sum('tot_ave');
        $consumos = Consumo::get();
        $lotesperiodo = Lote::where('periodo', Periodo::ativo())->get();
        $semanaatual = Semana::where('data_inicial', '<=', Carbon::now())->where('data_final', '>=', Carbon::now())->first();

        $producao = Coleta::where('data_coleta', '>=', $semanaatual->data_inicial)->where('data_coleta', '<=', $semanaatual->data_final)->get();

        $periodos = new DatePeriod(new DateTime($semanaatual->data_inicial), new DateInterval('P1D'), new DateTime($semanaatual->data_final));

        foreach ($periodos as $period):
            $datasemana[] = $period->format('d/m/Y');
        endforeach;

        foreach ($periodos as $periodo):
            $posturadia = Coleta::where('data_coleta', $periodo->format('Y-m-d'))->sum('postura_dia');
            $producaosemana[] = number_format(($posturadia / $lotesperiodo->sum->femea_capitalizada) * 100, 2, '.', '');
        endforeach;

        $media = number_format((($producao->sum->postura_dia / 7) / $lotesperiodo->sum->femea_capitalizada) * 100, 2, '.', '');
        $alcancada = number_format(($producao->sum->postura_dia / $lotesperiodo->sum->femea_capitalizada) * 100, 2, '.', '');

        return view('home.index', compact('lotes', 'aviarios', 'coletas', 'mortalidades', 'consumos', 'semanaatual', 'datasemana', 'producaosemana', 'media', 'alcancada'));
    }

}
