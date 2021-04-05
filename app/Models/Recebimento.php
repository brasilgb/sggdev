<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recebimento extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_recebimento';
    public $incrementing = false;
    protected $fillable = [
        'id_recebimento',
        'periodo',
        'lote_id',
        'data_recebimento',
        'hora_recebimento',
        'sexo_ave',
        'quantidade',
        'nota_fiscal'
    ];

    public function lotes() {
        return $this->hasOne(Lote::class, 'id_lote', 'lote_id');
    }

    public function scopeIdrecebimento() {
        $recebimentos = Recebimento::orderBy('id_recebimento', 'desc')->get();

        if ($recebimentos->count() > 0):
            foreach ($recebimentos as $recebimento):
                return $recebimento->id_recebimento + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
