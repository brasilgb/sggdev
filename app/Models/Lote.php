<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_lote';
    public $incrementing = false;
    protected $fillable = [
        'id_lote',
        'data_lote',
        'periodo',
        'lote',
        'femea',
        'macho'
    ];

    public function scopeIdlote() {
        $lastlote = Lote::orderBy('id_lote', 'desc')->get();

        if ($lastlote->count() > 0):
            foreach ($lastlote as $last):
                return $last->id_lote + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

    public function aviarios() {
        return $this->hasMany(Aviario::class, 'lote_id', 'id_lote');
    }

    public function envios() {
        return $this->hasMany(Envio::class, 'lote_id', 'id_lote');
    }

    public function estoque_aves() {
        return $this->hasMany(Estoque_aves::class, 'lote');
    }

    public function estoque_ovos() {
        return $this->hasMany(Estoque_ovos::class, 'lote_id');
    }

    public function mortalidades() {
        return $this->hasMany(Mortalidade::class, 'lote_id', 'id_lote');
    }

    public function pesagens() {
        return $this->hasMany(Pesagem::class, 'lote_id', 'id_lote');
    }


    public function recebimentos() {
        return $this->hasMany(Recebimento::class, 'lote_id', 'id_lote');
    }

    public function consumos() {
        return $this->hasMany(Consumo::class, 'lote_id', 'id_lote');
    }

    public function controles() {
        return $this->hasMany(Controlediario::class, 'lote_id', 'id_lote');
    }

}
