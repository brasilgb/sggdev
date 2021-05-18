<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_financeiro';
    public $incrementing = false;
    protected $fillable = [
        'id_financeiro',
        'periodo',
        'valor_ovo'
    ];

    public function scopeIdfinanceiro() {
        $financeiros = Financeiro::orderBy('id_financeiro', 'DESC')->get();

        if ($financeiros->count() > 0):
            foreach ($financeiros as $financeiro):
                return $financeiro->id_financeiro + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
