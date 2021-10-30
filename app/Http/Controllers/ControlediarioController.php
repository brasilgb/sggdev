<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Aviario;
use App\Models\Controlediario;
use App\Models\Lote;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControlediarioController extends Controller
{
    public function __construct()
    {
        if(Empresa::first()->segmento == 0){
            return redirect()->route('home')->send();
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controlediarios = Controlediario::where('periodo', Periodo::ativo())->orderBy('id_controle', 'DESC')->paginate(15);
        return view('controlediarios.index', compact('controlediarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Controlediario $controlediario)
    {
        $controlediario = $controlediario::get();
        $lotes = Lote::orderBy('lote', 'ASC')->get();
        return view('controlediarios.create', compact('lotes', 'controlediario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Controlediario $controlediario)
    {
        $data = $request->all();

        $rules = [
            'data_controle' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario' => 'required',
            'temperatura_max' => 'required',
            'temperatura_min' => 'required',
            'umidade' => 'required',
            'leitura_agua' => 'required|integer',
            'consumo_total' => 'required|integer',
            'consumo_ave' => 'required'
        ];

        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_controle'] = Controlediario::idcontrole();
        $data['periodo'] = Periodo::ativo();
        $data['data_controle'] = Carbon::createFromFormat('d/m/Y', $request->data_controle)->format('Y-m-d');
        $data['leitura_inicial'] = Controlediario::idcontrole() > 1 ? 0 : 1;
        $controlediario->create($data);
        return redirect()->route('controlediarios.index')->with('success', 'Controle diário cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function show(Controlediario $controlediario)
    {
        return view('controlediarios.edit', compact('controlediario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function edit(Controlediario $controlediario)
    {
        return redirect()->route('controlediarios.show', ['controlediario' => $controlediario->id_controle]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Controlediario $controlediario)
    {
        $data = $request->all();

        $rules = [
            'data_controle' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario' => 'required',
            'temperatura_max' => 'required',
            'temperatura_min' => 'required',
            'umidade' => 'required',
            'leitura_agua' => 'required|integer',
            'consumo_total' => 'required|integer',
            'consumo_ave' => 'required'
        ];

        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['data_controle'] = Carbon::createFromFormat('d/m/Y', $request->data_controle)->format('Y-m-d');

        $controlediario->update($data);
        return redirect()->route('controlediarios.show', ['controlediario' => $controlediario->id_controle])->with('success', 'Controle diário editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Controlediario $controlediario)
    {
        $controlediario->delete();
        return redirect()->route('controlediarios.index', ['controlediario' => $controlediario->id_controle])->with('success', 'Controle deletado com sucesso!');
    }

    public function verificacontrole(Request $request)
    {
        $controle = Controlediario::orderBy('id_controle', 'DESC')->where('lote_id', $request->idlote)->where('aviario', $request->idaviario)->first();
        $aviarios = Aviario::orderBy('id_aviario', 'DESC')->where('lote_id', $request->idlote)->where('id_aviario', $request->idaviario)->first();
        if (!empty($controle) and $controle->leitura_inicial > 0) {
            $leitura = '0';
            $leitura_inicial = $controle->leitura_inicial;
            $leitura_anterior = $controle->leitura_agua;
            $aves = $aviarios->tot_ave;
        } else {
            $leitura = '1';
            $leitura_inicial = '0';
            $leitura_anterior = '0';
            $aves = '0';
        }
        return response()->json(['leitura' => $leitura, 'aves' => $aves, 'leitura_inicial' => $leitura_inicial, 'leitura_anterior' => $leitura_anterior]);
    }

    public function editacontrole(Request $request)
    {
        $controle = Controlediario::orderBy('id_controle', 'DESC')->where('id_controle', $request->idcontrole)->first();
        $aviarios = Aviario::orderBy('id_aviario', 'DESC')->where('lote_id', $request->idlote)->where('id_aviario', $request->idaviario)->first();

            $leitura_inicial = $controle->leitura_inicial;
            $leitura_anterior = $controle->leitura_agua - $controle->consumo_total;
            $aves = $aviarios->tot_ave;

        return response()->json(['aves' => $aves, 'leitura_inicial' => $leitura_inicial, 'leitura_anterior' => $leitura_anterior]);
    }
}
