<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Periodo;
use App\Models\Semana;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periodos = Periodo::orderBy('id_periodo', 'DESC')->paginate(10);
        return view('periodos.index', compact('periodos'));
    }

    public function busca(Request $request)
    {
        $datainicial = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $periodos = Periodo::where('data_inicial', $datainicial)->paginate('10');
        $busca = true;
        return view('periodos.index', compact('periodos', 'busca'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($request->semana_inicial);
        $valid = $request->validate([
            'data_inicial' => 'date_format:"d/m/Y"|required',
            'semana_inicial' => 'required|integer',
            'semana_final' => 'required|integer'
        ]);
        $dataformatada = Carbon::createFromFormat('d/m/Y', $request->data_inicial)->format('Y-m-d');
        $data['id_periodo'] = Periodo::idperiodo();
        $data['data_inicial'] = $dataformatada;
        $data['ativo'] = 1;
        Periodo::create($data);
        Periodo::where('id_periodo', '<>', $data['id_periodo'])->where('ativo', 1)->update(['ativo' => 0]);

        $this->addSemanas($dataformatada, $data['semana_inicial'], $data['semana_final']);
        $this->addChecklist($dataformatada);
        return redirect()->route('periodos.index')->with('success', 'Período criado com sucesso!');
    }

    public function addSemanas($datainicio, $inicial, $final)
    {

        //Cria semanas com eclosão, fertilidade e produção
        $dataatrasada = date('Y-m-d', strtotime("-7 day", strtotime($datainicio)));
        $dtini = DateTime::createFromFormat('Y-m-d', $dataatrasada);
        $dtfin = DateTime::createFromFormat('Y-m-d', $datainicio);

        for ($i = $inicial; $i <= $final; $i++) {
            $data['periodo'] = Periodo::idperiodo() - 1;
            $data['semana'] = $i;
            $data['data_inicial'] = $dtini->add(new DateInterval('P7D'));
            $data['data_final'] = $dtfin->add(new DateInterval('P7D'));
            Semana::create($data);
        }
        //Adiciona data de término em períodos *****************************
        $semanas = Semana::orderBy('id_semana', 'desc')->first();
        Periodo::where('id_periodo', $semanas->periodo)->update(['desativacao' => $semanas->data_final]);
    }

    public function addChecklist($datainicio)
    {
        $mesatrasado = date('Y-m-d', strtotime("-1 month", strtotime($datainicio)));
        $dtmesinicial = DateTime::createFromFormat('Y-m-d', $mesatrasado);
        $dtmesfinal = DateTime::createFromFormat('Y-m-d', $datainicio);

        $datetime1 = new DateTime($datainicio);
        $dtfimsemana2 = Semana::orderBy('id_semana', 'desc')->first();
        $datetime2 = new DateTime($dtfimsemana2->data_final);
        $interval = $datetime1->diff($datetime2);
        for ($a = 1; $a <= $interval->format('%m'); $a++) {
            $data['periodo'] = Periodo::idperiodo() - 1;
            $data['mes'] = $a;
            $data['data_inicial'] = $dtmesinicial->add(new DateInterval('P1M'));
            $data['data_final'] = $dtmesfinal->add(new DateInterval('P1M'));
            Checklist::create($data);
        }
    }

    public function addsemanasperiodo(Request $request) {
        $lastdata = Semana::where('periodo', $request->idperiodo)->orderBy('id_semana', 'desc')->first();
        $semanainicial = $lastdata->semana + 1;
        $semanafinal = $lastdata->semana + $request->numsemanas;

        $dataini = DateTime::createFromFormat('Y-m-d', $lastdata->data_inicial);
        $dataad = date('Y-m-d', strtotime("+7 day", strtotime($lastdata->data_inicial)));
        $datafim = DateTime::createFromFormat('Y-m-d', $dataad);
        for ($i = $semanainicial; $i <= $semanafinal; $i++):
            Semana::where('periodo', $request->idperiodo)->create([
                'periodo' => $request->idperiodo,
                'semana' => $i,
                'data_inicial' => $dataini->add(new DateInterval('P7D')),
                'data_final' => $datafim->add(new DateInterval('P7D'))
            ]);
        endfor;
        //Adiciona data de término em períodos *****************************
        $dtfimsemana = Semana::orderBy('id_semana', 'desc')->first();
        Periodo::where('id_periodo', $request->idperiodo)->update(['desativacao' => $dtfimsemana->data_final]);
        //Cria checklist
        $dadoschechlist = Checklist::where('periodo', $request->idperiodo)->orderBy('id_checklist', 'desc')->first();
 //       $mesatrasado = date('Y-m-d', strtotime("-1 month", strtotime($dadoschechlist->data_inicial)));
        $dtmesinicial = new DateTime($dadoschechlist->data_inicial);
//        $mesadiantado = date('Y-m-d', strtotime("+1 month", strtotime($request->desativacao)));
        $dtmesfinal = new DateTime($dadoschechlist->data_final);

        $dtfimsemana2 = Semana::where('periodo', $request->idperiodo)->orderBy('id_semana', 'desc')->first();
        $datetime1 = new DateTime($dadoschechlist->data_inicial);
        $datetime2 = new DateTime($dtfimsemana2->data_final);
        $interval = $datetime1->diff($datetime2);
//        echo $interval->format('%m');exit;
        for ($a = 1; $a <= $interval->format('%m'); $a++) {
            Checklist::where('periodo', $request->idperiodo)->create([
                'periodo' => $request->idperiodo,
                'mes' => $dadoschechlist->mes + $a,
                'data_inicial' => $dtmesinicial->add(new DateInterval('P1M'))->format('Y-m-d'),
                'data_final' => $dtmesfinal->add(new DateInterval('P1M'))->format('Y-m-d')
            ]);
        }
        return redirect()->route('periodos.index')->with('success', 'Semanas adicionadas com sucesso ao período!');
    }

    public function ativaperiodo(Request $request, Periodo $periodo)
    {

        $periodo->where('ativo', '1')->update(['ativo' => '0']);
        if($request->ativo == '0'):
            $periodo->where('id_periodo', $request->idperiodo)->update(['ativo' => '1']);
        else:
            $periodo->where('id_periodo', $request->idperiodo)->update(['ativo' => '0']);
        endif;
        return true;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return redirect()->route('periodos.index')->with('success', 'Período removido com sucesso!');
    }
}
