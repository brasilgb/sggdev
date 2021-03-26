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
        'deformados',
        'sujos_cama',
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

    public function lote() {
        return $this->belongsTo(Lote::class, 'id_lote', 'lote_id');
    }

    public function aviario() {
        return $this->belongsTo(Aviario::class, 'id_aviario', 'id_aviario');
    }

}
