<?php

namespace App\Http\Controllers;

use App\Models\Aviario;
use App\Models\Coleta;
use App\Models\Empresa;
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

    public function movimentodiario()
    {
        $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
        $empresa = Empresa::first();
        $lotes = Lote::where('periodo', Periodo::ativo())->get();
        $coletas = Coleta::get();
        $mortalidades = Mortalidade::get();
        $estoqueaves = Estoque_ave::get();
        $envioovos = Envio::get();
        $estoqueovos = Estoque_ovo::get();
        $aviarios = Aviario::get();
        $envios = Envio::get();

        return view('relatorios.movimentodiario', compact('lotes', 'aviarios', 'coletas', 'datarelatorio','mortalidades', 'estoqueaves', 'envioovos', 'estoqueovos', 'envios', 'empresa'));
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
        $datarelatorio = date("Y-m-d", strtotime(Carbon::now()));
        $data = [
            'datarelatorio' => date("Y-m-d", strtotime(Carbon::now())),
            'empresa' => Empresa::first(),
            'lotes' => Lote::where('periodo', Periodo::ativo())->get(),
            'coletas' => Coleta::get(),
            'mortalidades' => Mortalidade::get(),
            'estoqueaves' => Estoque_ave::get(),
            'envioovos' => Envio::get(),
            'estoqueovos' => Estoque_ovo::get(),
            'aviarios' => Aviario::get(),
            'envios' => Envio::get()
        ];

        $relatoriodir = 'Relatorios';
        if(!is_dir(public_path(DIRECTORY_SEPARATOR . $relatoriodir))){
            mkdir(public_path(DIRECTORY_SEPARATOR . $relatoriodir));
        }
        $relatoriodir = 'Relatorios';
        $nomerelatorio = date("d_m_Y", strtotime($datarelatorio));
        $pdf_name = "relatorio-coletas-diario-$nomerelatorio.pdf";
        $path = public_path(DIRECTORY_SEPARATOR . $relatoriodir . DIRECTORY_SEPARATOR . $pdf_name);
        $pdf = PDF::loadView('relatorios.pdfcoletas', $data)->setPaper('a4', 'landscape')/*->save($path)*/;

        return $pdf->download('relatorio-coletas.pdf');
    }

}
