<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mortalidade extends Model
{
    use HasFactory;


    protected $primaryKey = 'id_mortalidade';
    public $incrementing = false;
    protected $fillable = [
        'id_mortalidade',
        'data_mortalidade',
        'id_aviario',
        'periodo',
        'lote_id',
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
        'tot_ave',
        'motivo'
    ];

    public function lotes() {
        return $this->hasOne(Lote::class, 'id_lote', 'lote_id');
    }

    public function aviarios() {
        return $this->hasOne(Aviario::class, 'id_aviario', 'id_aviario');
    }

    public function scopeIdmortalidade() {
        $mortalidades = Mortalidade::orderBy('id_mortalidade', 'DESC')->get();

        if ($mortalidades->count() > 0):
            foreach ($mortalidades as $mortalidade):
                return $mortalidade->id_mortalidade + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
