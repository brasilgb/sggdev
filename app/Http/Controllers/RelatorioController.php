<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Envio;
use App\Models\Estoque_ave;
use App\Models\Estoque_ovo;
use App\Models\Lote;
use App\Models\Mortalidade;
use App\Models\Periodo;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{

    public function coletas()
    {
        $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
        $lotes = Lote::where('periodo', Periodo::ativo())->get();
        $coletas = Coleta::get();
        $mortalidades = Mortalidade::get();
        $estoqueaves = Estoque_ave::get();
        $envioovos = Envio::get();
        $estoqueovos = Estoque_ovo::get();
        $aviarios = Aviario::get();
        $envios = Envio::get();

        return view('relatorios.coletas', compact('lotes', 'aviarios', 'coletas', 'datarelatorio','mortalidades', 'estoqueaves', 'envioovos', 'estoqueovos', 'envios'));
    }
    // public function pdfcoletas()
    // {
    //     $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
    //     $lotes = Lote::where('periodo', Periodo::ativo())->get();
    //     $coletas = Coleta::get();
    //     $mortalidades = Mortalidade::get();
    //     $estoqueaves = Estoque_ave::get();
    //     $envioovos = Envio::get();
    //     $estoqueovos = Estoque_ovo::get();
    //     $aviarios = Aviario::get();
    //     $envios = Envio::get();

    //     return view('relatorios.pdfcoletas', compact('lotes', 'aviarios', 'coletas', 'datarelatorio','mortalidades', 'estoqueaves', 'envioovos', 'estoqueovos', 'envios'));
    // }

    public function pdfcoletas()
    {
        $data = [
            'datarelatorio' => date("Y-m-d", strtotime(Carbon::now())),
            'lotes' => Lote::where('periodo', Periodo::ativo())->get(),
            'coletas' => Coleta::get(),
            'mortalidades' => Mortalidade::get(),
            'estoqueaves' => Estoque_ave::get(),
            'envioovos' => Envio::get(),
            'estoqueovos' => Estoque_ovo::get(),
            'aviarios' => Aviario::get(),
            'envios' => Envio::get()
        ];

        $pdf = PDF::loadView('relatorios.pdfcoletas', $data);

        return $pdf->download('relatorio-coletas.pdf');
    }

}
