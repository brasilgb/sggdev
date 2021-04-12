<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Semana;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    public function eclosao()
    {
        $semanas = $this->semanas();
        return view('metas.eclosao', compact('semanas'));
    }

    public function fertilidade()
    {
        $semanas = $this->semanas();
        return view('metas.fertilidade', compact('semanas'));
    }

    public function producao()
    {
        $semanas = $this->semanas();
        return view('metas.producao', compact('semanas'));
    }

    public function semanas()
    {
        return Semana::where('periodo', Periodo::ativo())->orderBy('id_semana', 'ASC')->get();
    }

}
