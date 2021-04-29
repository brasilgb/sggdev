<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Consumo;
use App\Models\Lote;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsumoController extends Controller
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
        $consumos = Consumo::where('periodo', Periodo::ativo())->where('periodo', Periodo::ativo())->orderBy('id_consumo', 'DESC')->paginate(15);

        return view('consumos.index', compact('consumos'));
    }

    public function busca(Request $request)
    {
        $dataconsumo = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $consumos = Consumo::where('data_consumo', $dataconsumo)->paginate(15);
        $busca = true;
        return view('consumos.index', compact('consumos', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('lote', 'ASC')->get();

        return view('consumos.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Consumo $consumo)
    {
        $data = $request->all();

        $rules = [
            'data_consumo' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario_id' => 'required',
            'femea_box1' => 'required',
            'femea_box2' => 'required',
            'femea_box3' => 'required',
            'femea_box4' => 'required',
            'macho_box1' => 'required',
            'macho_box2' => 'required',
            'macho_box3' => 'required',
            'macho_box4' => 'required',
            'femea' => 'required',
            'macho' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_consumo'] = Consumo::idconsumo();
        $data['periodo'] = Periodo::ativo();
        $data['data_consumo'] = Carbon::createFromFormat('d/m/Y', $request->data_consumo)->format('Y-m-d');

        $consumo->create($data);
        return redirect()->route('consumos.index')->with('success', 'Consumo adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function show(Consumo $consumo)
    {
        return view('consumos.edit', compact('consumo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumo $consumo)
    {
        return redirect()->route('consumos.show', ['consumo' => $consumo->id_consumo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumo $consumo)
    {
        $data = $request->all();

        $rules = [
            'data_consumo' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario_id' => 'required',
            'femea_box1' => 'required',
            'femea_box2' => 'required',
            'femea_box3' => 'required',
            'femea_box4' => 'required',
            'macho_box1' => 'required',
            'macho_box2' => 'required',
            'macho_box3' => 'required',
            'macho_box4' => 'required',
            'femea' => 'required',
            'macho' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['data_consumo'] = Carbon::createFromFormat('d/m/Y', $request->data_consumo)->format('Y-m-d');

        $consumo->update($data);
        return redirect()->route('consumos.show', ['consumo' => $consumo->id_consumo])->with('success', 'Consumo Editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Consumo  $consumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumo $consumo)
    {
        $consumo->delete();
        return redirect()->route('consumos.index')->with('success', 'Consumo deletado com sucesso!');
    }
}
