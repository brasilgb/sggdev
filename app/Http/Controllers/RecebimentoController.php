<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Lote;
use App\Models\Periodo;
use App\Models\Recebimento;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RecebimentoController extends Controller
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
        $recebimentos = Recebimento::where('periodo', Periodo::ativo())->orderBy('id_recebimento')->paginate(15);
        return view('recebimentos.index', compact('recebimentos'));
    }

    public function busca(Request $request)
    {
        $datarecebimento = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $recebimentos = Recebimento::where('data_recebimento', $datarecebimento)->paginate(15);
        $busca = true;
        return view('recebimentos.index', compact('recebimentos', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('lote', 'ASC')->get();
        return view('recebimentos.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Recebimento $recebimento)
    {
        $data = $request->all();
        $rules = [
        'lote_id' => 'required',
        'data_recebimento' => 'date_format:"d/m/Y"|required',
        'hora_recebimento' => 'date_format:"H:i"|required',
        'sexo_ave' => 'required',
        'quantidade' => 'required',
        'nota_fiscal' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_recebimento'] = Recebimento::idrecebimento();
        $data['periodo'] = Periodo::ativo();
        $data['data_recebimento'] = Carbon::createFromFormat('d/m/Y', $request->data_recebimento)->format('Y-m-d');

        $recebimento->create($data);
        return redirect()->route('recebimentos.index')->with('success', 'Recebimento de ração adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recebimento  $recebimento
     * @return \Illuminate\Http\Response
     */
    public function show(Recebimento $recebimento)
    {
        return view('recebimentos.edit', compact('recebimento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recebimento  $recebimento
     * @return \Illuminate\Http\Response
     */
    public function edit(Recebimento $recebimento)
    {
        return redirect()->route('recebimentos.show', ['recebimento' => $recebimento->id_recebimento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recebimento  $recebimento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recebimento $recebimento)
    {
        $data = $request->all();
        $rules = [
        'lote_id' => 'required',
        'data_recebimento' => 'date_format:"d/m/Y"|required',
        'hora_recebimento' => 'date_format:"H:i"|required',
        'sexo_ave' => 'required',
        'quantidade' => 'required',
        'nota_fiscal' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['data_recebimento'] = Carbon::createFromFormat('d/m/Y', $request->data_recebimento)->format('Y-m-d');

        $recebimento->update($data);
        return redirect()->route('recebimentos.show', ['recebimento' => $recebimento->id_recebimento])->with('success', 'Recebimento de ração editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recebimento  $recebimento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recebimento $recebimento)
    {
        $recebimento->delete();
        return redirect()->route('recebimentos.index')->with('success', 'Recebimento de ração deletado com sucesso!');
    }
}
