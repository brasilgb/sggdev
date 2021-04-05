<?php

namespace App\Http\Controllers;

use App\Models\Controlediario;
use App\Models\Lote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ControlediarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $controlediarios = Controlediario::orderBy('id_controle', 'DESC')->paginate(15);
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
        $controlediario = $controlediario::get();
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
        if($controlediario->count() > 0){

        }else{
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function show(Controlediario $controlediario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function edit(Controlediario $controlediario)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Controlediario  $controlediario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Controlediario $controlediario)
    {
        //
    }
}
