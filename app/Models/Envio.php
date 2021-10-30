<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_envio';
    public $incrementing = false;
    protected $fillable = [
        'id_envio',
        'data_envio',
        'hora_envio',
        'periodo',
        'lote_id',
        'incubaveis',
        'comerciais',
        'postura_dia'
    ];

    public function lotes() {
        return $this->hasOne(Lote::class, 'id_lote', 'lote_id');
    }

    public function scopeIdenvio() {
        $lastenvio = Envio::orderBy('id_envio', 'DESC')->get();

        if ($lastenvio->count() > 0):
            foreach ($lastenvio as $last):
                return $last->id_envio + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
