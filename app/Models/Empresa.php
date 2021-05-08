<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_empresa';
    public $incrementing = false;
    protected $fillable = [
        'id_empresa',
        'logotipo',
        'cnpj',
        'razao_social',
        'segmento',
        'endereco',
        'cidade',
        'uf',
        'telefone',
        'celular',
        'email'
    ];

        public function scopeIdempresa() {
        $empresas = Empresa::orderBy('id_empresa', 'desc')->get();

        if ($empresas->count() > 0):
            foreach ($empresas as $empresa):
                return $empresa->id_empresa + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
