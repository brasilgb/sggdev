<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Despesa;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DespesaController extends Controller
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
        $despesas = Despesa::where('periodo', Periodo::ativo())->orderBy('id_despesa', 'DESC')->paginate(15);
        return view('despesas.index', compact('despesas'));
    }

    public function busca(Request $request)
    {
        $vencimento = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $despesas = Despesa::where('vencimento', $vencimento)->paginate(15);
        $busca = true;
        return view('despesas.index', compact('despesas', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('despesas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Despesa $despesa)
    {
        $data = $request->all();

        $rules = [
            'vencimento' => 'date_format:"d/m/Y"|required',
            'descritivo' => 'required',
            'valor' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_despesa'] = Despesa::iddespesa();
        $data['periodo'] = Periodo::ativo();
        $data['vencimento'] = Carbon::createFromFormat('d/m/Y', $request->vencimento)->format('Y-m-d');
        $data['situacao'] = 'Aberta';

        $despesa->create($data);
        return redirect()->route('despesas.index')->with('success', 'Despesa adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function show(Despesa $despesa)
    {
        return view('despesas.edit', compact('despesa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Despesa $despesa)
    {
        return redirect()->route('despesas.show', ['despesa' => $despesa->id_despesa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Despesa $despesa)
    {
        $data = $request->all();

        $rules = [
            'vencimento' => 'date_format:"d/m/Y"|required',
            'descritivo' => 'required',
            'valor' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['vencimento'] = Carbon::createFromFormat('d/m/Y', $request->vencimento)->format('Y-m-d');

        $despesa->update($data);
        return redirect()->route('despesas.show', ['despesa' => $despesa->id_despesa])->with('success', 'Despesa editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Despesa  $despesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Despesa $despesa)
    {
        $despesa->delete();
        return redirect()->route('despesas.index')->with('success', 'Despesa deletado com sucesso!');
    }
}
