<?php

namespace App\Http\Controllers;

use App\Models\Coleta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
{

    public function relcoletas()
    {
        $data = date("Y-m-d", strtotime(Carbon::now()));
        $numcoletas = DB::table('coletas')->distinct()->get('coleta');
        $coletas = Coleta::where('data_coleta', $data)->groupBy('coleta')->get();

        return view('relatorios.relcoletas', compact('numcoletas', 'coletas'));
    }

}
