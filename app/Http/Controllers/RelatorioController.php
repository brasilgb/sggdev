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
        $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
        $numcoletas = Coleta::distinct()->get('coleta');

        return view('relatorios.relcoletas', compact('numcoletas', 'datarelatorio'));
    }

}
