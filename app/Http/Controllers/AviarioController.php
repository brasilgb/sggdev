<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Aviario;
use App\Models\Estoque_ave;
use App\Models\Lote;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AviarioController extends Controller
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
        $aviarios = Aviario::where('periodo', Periodo::ativo())->orderBy('id_aviario', 'DESC')->paginate(15);
        return view('aviarios.index', compact('aviarios'));
    }

    public function busca(Request $request)
    {
        $aviarios = Aviario::where('lote_id', $request->search)->paginate(15);
        $busca = true;
        return view('aviarios.index', compact('aviarios', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('id_lote', 'ASC')->get();
        return view('aviarios.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Aviario $aviario)
    {
        $data = $request->all();

        $rules = [
            'data_aviario' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario' => 'required',
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
        $data['id_aviario'] = Aviario::idaviario();
        $data['periodo'] = Periodo::ativo();
        $data['data_aviario'] = Carbon::createFromFormat('d/m/Y', $request->data_aviario)->format('Y-m-d');
        $data['tot_ave'] = $request->femea + $request->macho;

        $aviario->create($data);
        return redirect()->route('aviarios.index')->with('success', 'Aviario adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Aviario $aviario)
    {
        return view('aviarios.edit', compact('aviario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Aviario $aviario)
    {
        return redirect()->route('aviarios.show', ['aviario' => $aviario->id_aviario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aviario $aviario)
    {
        $data = $request->all();

        $rules = [
            'data_aviario' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'aviario' => 'required',
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
        $data['data_aviario'] = Carbon::createFromFormat('d/m/Y', $request->data_aviario)->format('Y-m-d');
        $data['tot_ave'] = $request->femea + $request->macho;

        $aviario->update($data);
        return redirect()->route('aviarios.show', ['aviario' => $aviario->id_aviario])->with('success', 'Aviario editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aviario $aviario)
    {
        $aviario->delete();
        return redirect()->route('aviarios.index')->with('success', 'Aviario deletado com sucesso!');
    }

    public function autocomplete(Request $request)
    {
        $termo = $request->termo;
        if ($termo == '') :
            $lotes = Lote::orderby('lote', 'ASC')->select('id_lote', 'lote')->limit(5)->get();
        else :
            $lotes = Lote::orderby('lote', 'ASC')->select('id_lote', 'lote')->where('lote', 'LIKE', $termo . '%')->get();
        endif;

        foreach ($lotes as $lote) {
            $response[] = ['value' => $lote->id_lote, 'label' => $lote->lote];
        }
        return response()->json($response);
    }

    public function aveslote(Request $request)
    {
        $estoqueaves = Estoque_ave::where('lote', $request->loteid)->get();

        $lotes       = Lote::where('id_lote', $request->loteid)->first();
        if ($estoqueaves->sum->tot_ave > 0){
            $femea = $lotes->femea - $estoqueaves->sum->femea;
            $macho = $lotes->macho - $estoqueaves->sum->macho;
        }else{
            $femea = $lotes->femea;
            $macho = $lotes->macho;
        }
        return response()->json(['femea' => $femea, 'macho' => $macho]);
    }

    public function aviarioslote(Request $request)
    {
        $aviarios = Aviario::where('lote_id', $request->idlote)->pluck("aviario", "id_aviario");
        return response()->json($aviarios);
    }
}
