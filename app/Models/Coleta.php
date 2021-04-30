<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coleta extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_coleta';
    public $incrementing = false;
    protected $fillable = [
        'id_coleta',
        'lote_id',
        'id_aviario',
        'periodo',
        'coleta',
        'data_coleta',
        'hora_coleta',
        'limpos_ninho',
        'sujos_ninho',
        'ovos_cama',
        'duas_gemas',
        'refugos',
        'pequenos',
        'casca_fina',
        'frios',
        'deformados',
        'sujos_cama',
        'esmagados_quebrados',
        'cama_nao_incubaveis',
        'trincados',
        'eliminados',
        'incubaveis_bons',
        'incubaveis',
        'comerciais',
        'postura_dia'
    ];

    public function scopeIdcoleta() {
        $lastcoleta = Coleta::orderBy('id_coleta', 'desc')->get();

        if ($lastcoleta->count() > 0):
            foreach ($lastcoleta as $last):
                return $last->id_coleta + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

    public function aviarios() {
        return $this->hasOne(Aviario::class, 'id_aviario', 'id_aviario');
    }

}
