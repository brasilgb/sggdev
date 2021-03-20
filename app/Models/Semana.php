<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semana extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_semana';
//    public $incrementing = true;
    protected $fillable = [
        'periodo',
        'semana',
        'data_inicial',
        'data_final',
        'eclosao',
        'fertilidade',
        'producao'
    ];

    public function periodos()
    {
        return $this->belongsTo(Periodo::class, 'id_periodo', 'periodo');
    }
}
