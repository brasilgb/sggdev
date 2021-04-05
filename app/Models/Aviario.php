<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aviario extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_aviario';
    public $incrementing = false;
    protected $fillable = [
        'id_aviario',
        'data_aviario',
        'periodo',
        'lote_id',
        'aviario',
        'femea_box1',
        'femea_box2',
        'femea_box3',
        'femea_box4',
        'macho_box1',
        'macho_box2',
        'macho_box3',
        'macho_box4',
        'femea',
        'macho',
        'tot_ave'
    ];

    public function scopeIdaviario() {
        $lastaviario = Aviario::orderBy('id_aviario', 'desc')->get();

        if ($lastaviario->count() > 0):
            foreach ($lastaviario as $last):
                return $last->id_aviario + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

    public function lotes() {
        return $this->hasOne(Lote::class, 'id_lote', 'lote_id');
    }

    public function coletas() {
        return $this->hasMany(Coleta::class, 'id_aviario', 'id_aviario');
    }

    public function mortalidades() {
        return $this->hasMany(Mortalidade::class, 'id_aviario', 'id_aviario');
    }

    public function pesagens() {
        return $this->hasMany(Pesagem::class, 'id_aviario', 'aviario_id');
    }

    public function consumos() {
        return $this->hasMany(Consumo::class, 'lote_id', 'id_lote');
    }

    public function controles() {
        return $this->hasMany(Controlediario::class, 'aviario', 'id_aviario');
    }

}
