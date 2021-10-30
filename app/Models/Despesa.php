<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_despesa';
    public $incrementing = false;
    protected $fillable = [
        'id_despesa',
        'periodo',
        'vencimento',
        'descritivo',
        'valor',
        'observacao',
        'situacao'
    ];

    public function scopeIddespesa() {
        $despesas = Despesa::orderBy('id_despesa', 'desc')->get();

        if ($despesas->count() > 0):
            foreach ($despesas as $despesa):
                return $despesa->id_despesa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
