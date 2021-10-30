<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_periodo';
    public $incrementing = false;
    protected $fillable = [
        'id_periodo',
        'semana_inicial',
        'semana_final',
        'data_inicial',
        'ativo',
        'desativacao'
    ];

    public function scopeIdperiodo() {
        $periodo = Periodo::orderBy('id_periodo', 'desc')->get();

        if ($periodo->count() > 0):
            foreach ($periodo as $last):
                return $last->id_periodo + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

    public function scopeAtivo()
    {
        $periodo = Periodo::where('ativo', 1)->first();
        if($periodo):
            return $periodo->id_periodo;
        else:
            return 0;
        endif;
    }

    public function semanas()
    {
        return $this->hasMany(Semana::class, 'periodo', 'id_periodo');
    }
}
