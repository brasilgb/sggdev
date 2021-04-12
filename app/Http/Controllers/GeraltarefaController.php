<?php

namespace App\Http\Controllers;

use App\Models\Geraltarefa;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeraltarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $geraltarefas = Geraltarefa::where('periodo', Periodo::ativo())->orderBy('id_tarefa')->paginate(15);
        return view('geraltarefas.index', compact('geraltarefas'));
    }

    public function busca(Request $request)
    {
        $datatarefa = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $geraltarefas = Geraltarefa::where('data_inicio', $datatarefa)->paginate(15);
        $busca = true;
        return view('geraltarefas.index', compact('geraltarefas', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('geraltarefas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Geraltarefa $geraltarefa)
    {
        $data = $request->all();
        $rules = [
            'data_inicio' => 'required',
            'hora_inicio' => 'required',
            'data_previsao' => 'required',
            'hora_previsao' => 'required',
            'descritivo' => 'required',
            'descricao' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_tarefa'] = Geraltarefa::idtarefa();
        $data['periodo'] = Periodo::ativo();
        $data['data_inicio'] = Carbon::createFromFormat('d/m/Y', $request->data_inicio)->format('Y-m-d');
        $data['data_previsao'] = Carbon::createFromFormat('d/m/Y', $request->data_previsao)->format('Y-m-d');
        $data['situacao'] = 'Aberta';
        $geraltarefa->create($data);
        return redirect()->route('geraltarefas.index')->with('success', 'Tarefa adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Geraltarefa  $geraltarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Geraltarefa $geraltarefa)
    {
        return view('geraltarefas.edit', compact('geraltarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Geraltarefa  $geraltarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Geraltarefa $geraltarefa)
    {
        return redirect()->route('geraltarefas.show', ['geraltarefa' => $geraltarefa->id_tarefa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Geraltarefa  $geraltarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Geraltarefa $geraltarefa)
    {
        $data = $request->all();
        $rules = [
            'data_inicio' => 'required',
            'hora_inicio' => 'required',
            'data_previsao' => 'required',
            'hora_previsao' => 'required',
            'descritivo' => 'required',
            'descricao' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $data['data_inicio'] = Carbon::createFromFormat('d/m/Y', $request->data_inicio)->format('Y-m-d');
        $data['data_previsao'] = Carbon::createFromFormat('d/m/Y', $request->data_previsao)->format('Y-m-d');
        $geraltarefa->update($data);
        return redirect()->route('geraltarefas.show', ['geraltarefa' => $geraltarefa->id_tarefa])->with('success', 'Tarefa editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Geraltarefa  $geraltarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Geraltarefa $geraltarefa)
    {
        $geraltarefa->delete();
        return redirect()->route('geraltarefas.index')->with('success', 'Tarefa deletada com sucesso!');
    }
}
