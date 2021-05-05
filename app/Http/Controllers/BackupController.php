<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Backup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BackupController extends Controller
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
        $backups = backup::first();
        if ($backups) :
            return redirect()->route('backups.show', ['backup' => $backups->id_backup]);
        else :
            return redirect()->route('backups.create');
        endif;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Backup $backup)
    {
        $data = $request->all();
        $rules = [
            'local' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $data['id_backup'] = Backup::idbackup();
        $backup->create($data);
        return redirect()->route('backups.show', ['backup' => Backup::idbackup() - 1])->with('success', 'Configurações de backup salva com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function show(Backup $backup)
    {
        return view('backups.edit', compact('backup'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function edit(Backup $backup)
    {
        return redirect()->route('backups.show', ['backup' => $backup->id_backup])->with('success', 'Configurações de Backup salvas com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Backup $backup)
    {
        $data = $request->all();
        $rules = [
            'local' => 'required'
        ];
        $messages = [
            'required' => 'O campo :attribute deve ser preenchido!',
            'integer' => 'O campo :attribute só aceita inteiros!',
            'date_format' => 'O campo data do aviário só aceita datas!',
            'unique' => 'O nome do :attribute já existe na base de dados!'
        ];
        $validator = Validator::make($data, $rules, $messages)->validate();

        $backup->update($data);
        return redirect()->route('backups.show', ['backup' => Backup::idbackup() - 1])->with('success', 'Configurações de backup salva com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backup  $backup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backup $backup)
    {
        //
    }

    public function executabackup()
    {
        $horaatual = date("H:i:s", strtotime(Carbon::now()));
        $horaagendada = date("H:i:s", strtotime(Backup::first()->agendamento));
        if ($horaatual == $horaagendada) {
            $this->createbackup();
        }
    }
    public function gerabackup()
    {
        $this->createbackup();
        return back();
    }

    public function createbackup()
    {
        $backup = Backup::first();
        $host = env('DB_HOST');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $file = $backup->local .DIRECTORY_SEPARATOR. 'backup-sgga.sql';

        if (!is_dir($backup->local)) {
            mkdir($backup->local, 0777, true);
        }
        $dump = "C:\webserver\mariadb\bin\mysqldump -u {$username} -p{$password} -h {$host} {$database} > {$file}";
        shell_exec($dump);
    }
}
