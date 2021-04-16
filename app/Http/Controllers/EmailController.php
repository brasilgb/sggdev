<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = Email::first();
        if ($emails):
            return redirect()->route('emails.show', ['email' => $emails->id_email]);
        else:
            return redirect()->route('emails.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('emails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Email $email)
    {
        $data = $request->all();
        $rules = [
            'smtp' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'remetente' => 'required',
            'destinatario' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $data['id_email'] = Email::idemail();
        $email->create($data);
        return redirect()->route('emails.show', ['email' => Email::idemail()-1])->with('success', 'Configurações de e-mail salva com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        return view('emails.edit', compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        return redirect()->route('emails.show', ['email' => $email->id_email]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        $data = $request->all();
        $rules = [
            'smtp' => 'required',
            'porta' => 'required',
            'seguranca' => 'required',
            'usuario' => 'required',
            'senha' => 'required',
            'remetente' => 'required',
            'destinatario' => 'required',
            'assunto' => 'required',
            'mensagem' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $email->update($data);
        return redirect()->route('emails.show', ['email' => $email->id_email])->with('success', 'Configurações de e-mail salva com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }
}
