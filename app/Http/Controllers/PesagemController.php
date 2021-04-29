<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Lote;
use App\Models\Periodo;
use App\Models\Pesagem;
use App\Models\Semana;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PesagemController extends Controller
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
        $pesagens = Pesagem::where('periodo', Periodo::ativo())->orderBy('id_peso')->paginate(15);
        return view('pesagens.index', compact('pesagens'));
    }

    public function busca(Request $request)
    {
        $datapesagem = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $pesagens = Pesagem::where('data_peso', $datapesagem)->paginate(15);
        $busca = true;
        return view('pesagens.index', compact('pesagens', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('lote', 'ASC')->get();
        $semanas = Semana::orderBy('semana', 'ASC')->get();
        return view('pesagens.create', compact('lotes', 'semanas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pesagem $pesagem)
    {
        $data = $request->all();

        $rules = [
            'data_peso' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario_id' => 'required',
            'semana' => 'required',
            'femea_box1' => 'required',
            'femea_box2' => 'required',
            'femea_box3' => 'required',
            'femea_box4' => 'required',
            'macho_box1' => 'required',
            'macho_box2' => 'required',
            'macho_box3' => 'required',
            'macho_box4' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_peso'] = Pesagem::idpeso();
        $data['periodo'] = Periodo::ativo();
        $data['data_peso'] = Carbon::createFromFormat('d/m/Y', $request->data_peso)->format('Y-m-d');

        $pesagem->create($data);
        return redirect()->route('pesagens.index')->with('success', 'Pesagem adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function show(Pesagem $pesagem)
    {
        return view('pesagens.edit', compact('pesagem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesagem $pesagem)
    {
        return redirect()->route('pesagens.show', ['pesagem' => $pesagem->id_peso]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesagem $pesagem)
    {
        $data = $request->all();

        $rules = [
            'data_peso' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario_id' => 'required',
            'semana' => 'required',
            'femea_box1' => 'required',
            'femea_box2' => 'required',
            'femea_box3' => 'required',
            'femea_box4' => 'required',
            'macho_box1' => 'required',
            'macho_box2' => 'required',
            'macho_box3' => 'required',
            'macho_box4' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
       $data['data_peso'] = Carbon::createFromFormat('d/m/Y', $request->data_peso)->format('Y-m-d');

        $pesagem->update($data);
        return redirect()->route('pesagens.show', ['pesagem' => $pesagem->id_peso])->with('success', 'Pesagem editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesagem  $pesagem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesagem $pesagem)
    {
        $pesagem->delete();
        return redirect()->route('pesagens.index')->with('success', 'Pesagem deletada com sucesso!');
    }
}
