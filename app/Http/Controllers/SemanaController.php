<?php

namespace App\Http\Controllers;

use App\Models\Periodo;
use App\Models\Semana;
use Illuminate\Http\Request;

class SemanaController extends Controller
{
    public function producao() {
        $ativo = Periodo::ativo();
        $producao = Semana::where('periodo', $ativo)->get();

        return view('semanas.producao', compact('producao'));
    }

    public function update(Semana $semana) {
       $semana->where('id_semana', $semana)->update(['producao' => $semana]);
    }
}
