<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Controlediario extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_controle';
    public $incrementing = false;

    protected $fillable = [
        'id_controle',
        'periodo',
        'lote_id',
        'aviario',
        'data_controle',
        'temperatura_max',
        'temperatura_min',
        'umidade',
        'leitura_agua',
        'consumo_total',
        'consumo_ave',
        'valorinicial'
    ];

    public function lotes() {
        return $this->hasOne(Lote::class, 'lote_id');
    }

    public function scopeIdcontrole() {
        $controlediario = Controlediario::orderBy('id_controle', 'desc')->get();

        if ($controlediario->count() > 0):
            foreach ($controlediario as $controle):
                return $controle->id_controle + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
