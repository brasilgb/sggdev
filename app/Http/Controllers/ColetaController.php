<?php

namespace App\Http\Controllers;

use App\Models\Coleta;
use App\Models\Lote;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coletas = Coleta::where('data_coleta', date("Y-m-d", strtotime(now())))->where('periodo', Periodo::ativo())->orderBy('id_coleta', 'DESC')->paginate(15);
        return view('coletas.index', compact('coletas'));
    }

    public function busca(Request $request)
    {
        $datacoleta = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $coletas = Coleta::where('data_coleta', $datacoleta)->paginate(15);
        $busca = true;
        return view('coletas.index', compact('coletas', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('id_lote', 'ASC')->get();
        return view('coletas.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Coleta $coleta)
    {
        $data = $request->all();

        $rules = [
            'data_coleta' => 'date_format:"d/m/Y"|required',
            'hora_coleta' => 'date_format:"H:i"|required',
            'lote_id' => 'required|integer',
            'id_aviario' => 'required|integer',
            'coleta' => 'required|integer',
            'limpos_ninho' => 'required|integer',
            'sujos_ninho' => 'required|integer',
            'ovos_cama' => 'required|integer',
            'duas_gemas' => 'required|integer',
            'refugos' => 'required|integer',
            'deformados' => 'required|integer',
            'sujos_cama' => 'required|integer',
            'trincados' => 'required|integer',
            'eliminados' => 'required|integer',
            'incubaveis_bons' => 'required|integer',
            'incubaveis' => 'required|integer',
            'comerciais' => 'required|integer',
            'postura_dia' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['id_coleta'] = Coleta::idcoleta();
        $data['periodo'] = Periodo::ativo();
        $data['data_coleta'] = Carbon::createFromFormat('d/m/Y', $request->data_coleta)->format('Y-m-d');

        $coleta->create($data);
        return redirect()->route('coletas.index')->with('success', 'Coleta adicionada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coleta  $coleta
     * @return \Illuminate\Http\Response
     */
    public function show(Coleta $coleta)
    {
        return view('coletas.edit', compact('coleta'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coleta  $coleta
     * @return \Illuminate\Http\Response
     */
    public function edit(Coleta $coleta)
    {
        return redirect()->route('coletas.show', ['coleta' => $coleta->id_coleta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coleta  $coleta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coleta $coleta)
    {
        $data = $request->all();
        $rules = [
            'data_coleta' => 'date_format:"d/m/Y"|required',
            'hora_coleta' => 'date_format:"H:i"|required',
            'lote_id' => 'required|integer',
            'id_aviario' => 'required|integer',
            'coleta' => 'required|integer',
            'limpos_ninho' => 'required|integer',
            'sujos_ninho' => 'required|integer',
            'ovos_cama' => 'required|integer',
            'duas_gemas' => 'required|integer',
            'refugos' => 'required|integer',
            'deformados' => 'required|integer',
            'sujos_cama' => 'required|integer',
            'trincados' => 'required|integer',
            'eliminados' => 'required|integer',
            'incubaveis_bons' => 'required|integer',
            'incubaveis' => 'required|integer',
            'comerciais' => 'required|integer',
            'postura_dia' => 'required|integer'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        $data['data_coleta'] = Carbon::createFromFormat('d/m/Y', $request->data_coleta)->format('Y-m-d');

        $coleta->update($data);
        return redirect()->route('coletas.show', ['coleta' => $coleta->id_coleta])->with('success', 'Coleta editada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coleta  $coleta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coleta $coleta)
    {
        $coleta->delete();
        return redirect()->route('coletas.index')->with('success', 'Coleta excluida com sucesso!');
    }

    public function numcoleta(Request $request)
    {
        $coleta = Coleta::where('lote_id', $request->idlote)->where('id_aviario', $request->idaviario)->orderBy('coleta', 'DESC')->first();
        if ($coleta) {
            $response = $coleta->coleta + 1;
        } else {
            $response = 1;
        }
        return response()->json($response);
    }
}
