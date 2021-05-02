<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Models\User as Usuario;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
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
        $usuarios = Usuario::orderBy('id', 'DESC')->paginate(15);
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Busca de usuarios
     */
    public function busca(Request $request)
    {
        $busca = $request->input('search');
        $usuarios = Usuario::where('id', $busca)->paginate(15);
        return view('usuarios.index', compact('usuarios', 'busca'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Usuario $usuario)
    {
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'username' => 'required|unique:users',
            'funcao' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'confirmed' => 'As senhas devem ser iguais!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $data['id'] = Usuario::idusuario();
        $data['password'] = Hash::make($request->password);
        $usuario->create($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario $usuario)
    {
        return redirect()->route('usuarios.show', ['usuario' => $usuario->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {

        $data = $request->all();
        $rules = [
            'name' => 'required',
            'username' => 'required',
            $usuario->id == 1 ? "'funcao' => 'required'" :''
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo :attribute só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!',
            'confirmed' => 'As senhas devem ser iguais!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        if (empty($request->password)) :
            $data['password'] = $request->bdpassword;
        else :
            $data['password'] = Hash::make($request->password);
        endif;
        $usuario->update($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario adicionado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario deletado com sucesso!');
    }

    /**
     * Autocomplete campo usuario
     */
    public function autocomplete(Request $request)
    {
        $termo = $request->termo;
        if ($termo == '') :
            $usuarios = Usuario::orderby('name', 'ASC')->select('id', 'name')->limit(5)->get();
        else :
            $usuarios = Usuario::orderby('name', 'ASC')->select('id', 'name')->where('name', 'LIKE', $termo . '%')->get();
        endif;

        foreach ($usuarios as $usuario) {
            $response[] = ['value' => $usuario->id, 'label' => $usuario->name];
        }
        return response()->json($response);
    }

}
