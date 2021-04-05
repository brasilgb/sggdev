<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_consumo';
    public $incrementing = false;
    protected $fillable = [
        'id_consumo',
        'data_consumo',
        'periodo',
        'lote_id',
        'aviario_id',
        'femea_box1',
        'femea_box2',
        'femea_box3',
        'femea_box4',
        'macho_box1',
        'macho_box2',
        'macho_box3',
        'macho_box4',
        'femea',
        'macho'
    ];

    public function lotes() {
        return $this->hasOne(Lote::class, 'id_lote', 'lote_id');
    }

    public function aviarios() {
        return $this->hasOne(Aviario::class, 'id_aviario', 'aviario_id');
    }

    public function scopeIdconsumo() {
        $cosumos = Consumo::orderBy('id_consumo', 'desc')->get();

        if ($cosumos->count() > 0):
            foreach ($cosumos as $cosumo):
                return $cosumo->id_consumo + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
