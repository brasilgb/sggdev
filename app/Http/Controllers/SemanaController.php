<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Periodo;
use App\Models\Semana;
use Illuminate\Http\Request;

class SemanaController extends Controller
{
    public function __construct()
    {
        if(Empresa::first()->segmento == 0){
            return redirect()->route('home')->send();
        }
    }
    public function producao() {
        $producao = Semana::where('periodo', Periodo::ativo())->get();

        return view('semanas.producao', compact('producao'));
    }

    public function update(Semana $semana) {
       $semana->where('id_semana', $semana)->update(['producao' => $semana]);
    }
}
