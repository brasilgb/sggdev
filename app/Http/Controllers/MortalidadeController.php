<?php

namespace App\Http\Controllers;

use App\Models\Lote;
use App\Models\Mortalidade;
use App\Models\Periodo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MortalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mortalidades = Mortalidade::where('periodo', Periodo::ativo())->orderBy('id_mortalidade', 'DESC')->paginate(15);

        return view('mortalidades.index', compact('mortalidades'));
    }

    public function busca(Request $request)
    {
        $datamortalidade = Carbon::createFromFormat('d/m/Y', $request->search)->format('Y-m-d');

        $mortalidades = Mortalidade::where('data_mortalidade', $datamortalidade)->paginate(15);
        $busca = true;
        return view('mortalidades.index', compact('mortalidades', 'busca'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lotes = Lote::orderBy('lote', 'ASC')->get();
        return view('mortalidades.create', compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Mortalidade $mortalidade)
    {
        $data = $request->all();

        $rules = [
            'data_mortalidade' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'id_aviario' => 'required',
            'motivo' => 'required',
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
        $data['id_mortalidade'] = Mortalidade::idmortalidade();
        $data['periodo'] = Periodo::ativo();
        $data['data_mortalidade'] = Carbon::createFromFormat('d/m/Y', $request->data_mortalidade)->format('Y-m-d');
        $data['tot_ave'] = $request->femea + $request->macho;

        $mortalidade->create($data);
        return redirect()->route('mortalidades.index')->with('success', 'Baixa de aves efetuada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mortalidade  $mortalidade
     * @return \Illuminate\Http\Response
     */
    public function show(Mortalidade $mortalidade)
    {
        return view('mortalidades.edit', compact('mortalidade'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mortalidade  $mortalidade
     * @return \Illuminate\Http\Response
     */
    public function edit(Mortalidade $mortalidade)
    {
        return redirect()->route('mortalidades.show', ['mortalidade' => $mortalidade->id_mortalidade]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mortalidade  $mortalidade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mortalidade $mortalidade)
    {
        $data = $request->all();

        $rules = [
            'data_mortalidade' => 'date_format:"d/m/Y"|required',
            'lote_id' => 'required',
            'id_aviario' => 'required',
            'motivo' => 'required',
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
        $data['data_mortalidade'] = Carbon::createFromFormat('d/m/Y', $request->data_mortalidade)->format('Y-m-d');
        $data['tot_ave'] = $request->femea + $request->macho;

        $mortalidade->update($data);
        return redirect()->route('mortalidades.show', ['mortalidade' => $mortalidade->id_mortalidade])->with('success', 'Baixa de aves alterada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mortalidade  $mortalidade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mortalidade $mortalidade)
    {
        $mortalidade->delete();
        return redirect()->route('mortalidades.index')->with('success', 'Baixa de aves deletada com sucesso!');
    }
}
