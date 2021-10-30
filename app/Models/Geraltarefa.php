<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geraltarefa extends Model
{
    use HasFactory;

    protected $table = 'geraltarefas';
    protected $primaryKey = 'id_tarefa';
    public $incrementing = false;
    protected $fillable = [
        'id_tarefa',
        'periodo',
        'data_inicio',
        'hora_inicio',
        'data_previsao',
        'hora_previsao',
        'descritivo',
        'descricao',
        'data_termino',
        'hora_termino',
        'situacao',
        'observacao'
    ];

    public function scopeIdtarefa() {
        $geraltarefa = Geraltarefa::orderBy('id_tarefa', 'desc')->get();

        if ($geraltarefa->count() > 0):
            foreach ($geraltarefa as $tarefa):
                return $tarefa->id_tarefa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
