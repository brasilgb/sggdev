<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Consumo;
use App\Models\Lote;
use App\Models\Mortalidade;
use App\Models\Semana;
use Carbon\Carbon;
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

        $semanaatual = Semana::where('data_inicial', '<=', Carbon::now())->where('data_final', '>=', Carbon::now())->first();

        return view('home.index', compact('lotes', 'aviarios', 'coletas', 'mortalidades', 'consumos', 'semanaatual'));
    }

}
