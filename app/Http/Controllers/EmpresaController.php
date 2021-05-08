<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::first();
        if ($empresas):
            return redirect()->route('empresas.show', ['empresa' => $empresas->id_empresa]);
        else:
            return redirect()->route('empresas.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Empresa $empresa)
    {

        $data = $request->all();

        $rules = [
            'logotipo' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
            'cnpj' => 'required',
            'razao_social' => 'required',
            'endereco' => 'required',
            'cidade' => 'required',
            'uf' => 'required',
            'celular' => 'required',
            'email' => 'required|email'
        ];

        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do lote só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'email' => 'Digite um e-mail válido',
            'image' => 'Arquivo de imagem não é válido, Arquivos: jpg, png ou gif, Tamanho: 1MB!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();
        if($request->file('logotipo')){

        if (!is_dir(public_path('/storage/thumbnail')) && !is_dir(public_path('/storage/images'))):
            mkdir(public_path('/storage/thumbnail'), 0777);
            mkdir(public_path('/storage/images'), 0777);
        endif;

        $image = $request->file('logotipo');
        $nomeimagem = time() . '.' . $image->extension();
        $destinationPath = public_path('/storage/thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $nomeimagem);
        $destinationPath = public_path('/storage/images');
        $image->move($destinationPath, $nomeimagem);
        unlink(public_path('/storage/images/' . $nomeimagem));
        $data['logotipo'] = $nomeimagem;
    }
        $data['id_empresa'] = Empresa::idempresa();

        if(Empresa::first()){
            $empresa->create($data);
            return redirect()->route('empresas.show', ['empresa' => Empresa::idempresa()-1])->with('success', 'Dados da empresa salvos com sucesso!');
        }else{
            $empresa->create($data);
            return redirect()->route('periodos.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.edit', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return redirect()->route('empresas.show', ['empresa' => $empresa->id_empresa]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        {

            $data = $request->all();

            $rules = [
                'logotipo' => 'image|mimes:jpeg,png,jpg,gif|max:1024',
                'cnpj' => 'required',
                'razao_social' => 'required',
                'endereco' => 'required',
                'cidade' => 'required',
                'uf' => 'required',
                'celular' => 'required',
                'email' => 'required|email'
            ];

            $messages = [
                'required' => 'O campo :attribute deve ser preenchido!',
                'integer' => 'O campo :attribute só aceita inteiros!',
                'date_format' => 'O campo data do lote só aceita datas!',
                'unique' => 'O nome do :attribute já existe na base de dados!',
                'email' => 'Digite um e-mail válido',
                'image' => 'Arquivo de imagem não é válido, Arquivos: jpg, png ou gif, Tamanho: 1MB!'
            ];
            $validator = Validator::make($data, $rules, $messages)->validate();

            if($request->has('logotipo')){
            if(is_file(public_path('/storage/thumbnail/' . $empresa->logotipo))){
                unlink(public_path('/storage/thumbnail/' . $empresa->logotipo));
            }
            if (!is_dir(public_path('/storage/thumbnail')) && !is_dir(public_path('/storage/images'))):
                mkdir(public_path('/storage/thumbnail'), 0777);
                mkdir(public_path('/storage/images'), 0777);
            endif;

            $image = $request->file('logotipo');
            $nomeimagem = time() . '.' . $image->extension();
            $destinationPath = public_path('/storage/thumbnail');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $nomeimagem);
            $destinationPath = public_path('/storage/images');
            $image->move($destinationPath, $nomeimagem);
            unlink(public_path('/storage/images/' . $nomeimagem));
            }
            $data['logotipo'] = $request->has('logotipo') ? $nomeimagem : $request->logotipodb;
            $empresa->update($data);
            return redirect()->route('empresas.show', ['empresa' => $empresa->id_empresa])->with('success', 'Configurações da empresa salva com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function delimagem(Request $request, Empresa $empresa)
    {
        if(is_file(public_path('/storage/thumbnail/' . $request->thumbnail))){
            unlink(public_path('/storage/thumbnail/' . $request->thumbnail));
        }
        $empresa->where('id_empresa', $request->idempresa)->update(['logotipo' => '']);
    }

    public function destroy(Empresa $empresa)
    {
        //
    }
}
