<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Estoque_ovo;
use App\Models\Lote;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $envios = Envio::orderBy('id_envio', 'DESC')->paginate(15);
        return view('envios.index', compact('envios'));
    }

    public function busca(Request $request)
    {
        $dataenvio = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $envios = Envio::where('data_envio', $dataenvio)->paginate(15);
        $busca = true;
        return view('envios.index', compact('envios', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('id_lote', 'DESC')->get();
        return view('envios.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Envio $envio)
    {
        $data = $request->all();
        $rules = [
            'data_envio' => 'date_format:"d/m/Y"|required',
            'hora_envio' => 'required',
            'lote_id' => 'required',
            'incubaveis' => 'required',
            'comerciais' => 'required',
            'postura_dia' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_envio'] = Envio::idenvio();
        $data['periodo'] = Periodo::ativo();
        $data['data_envio'] = Carbon::createFromFormat('d/m/Y', $request->data_envio)->format('Y-m-d');

        $envio->create($data);
        return redirect()->route('envios.index')->with('success', 'Envio adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function show(Envio $envio)
    {
        return view('envios.edit', compact('envio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function edit(Envio $envio)
    {
        return redirect()->route('envios.show', ['envio' => $envio->id_envio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Envio $envio)
    {
        $data = $request->all();
        $rules = [
            'data_envio' => 'date_format:"d/m/Y"|required',
            'hora_envio' => 'required',
            'lote_id' => 'required',
            'incubaveis' => 'required',
            'comerciais' => 'required',
            'postura_dia' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['data_envio'] = Carbon::createFromFormat('d/m/Y', $request->data_envio)->format('Y-m-d');

        $envio->update($data);
        return redirect()->route('envios.edit', ['envio' => $envio->id_envio])->with('success', 'Envio Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Envio  $envio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Envio $envio)
    {
        $envio->delete();
        return redirect()->route('envios.index')->with('success', 'Envio deletado com sucesso!');
    }

    public function ovoslote(Request $request)
    {
        $estoqueovos = Estoque_ovo::where('lote_id', $request->loteid)->first();
            $incubaveis = $estoqueovos->incubaveis;
            $comerciais = $estoqueovos->comerciais;
        return response()->json(['incubaveis' => $incubaveis, 'comerciais' => $comerciais]);
    }

}
