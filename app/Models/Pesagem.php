<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesagem extends Model
{
    use HasFactory;

    protected $table = 'pesos';
    protected $primaryKey = 'id_peso';
    public  $incrementing = false;
    protected $fillable =[
        'id_peso',
        'data_peso',
        'periodo',
        'lote_id',
        'aviario_id',
        'semana',
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

    public function semanas() {
        return $this->hasOne(Semana::class, 'id_semana', 'semana');
    }

    public function scopeIdpeso() {
        $pesagens = Pesagem::orderBy('id_peso', 'desc')->get();

        if ($pesagens->count() > 0):
            foreach ($pesagens as $pesagem):
                return $pesagem->id_peso + 1;
            endforeach;
        else:
            return 1;
        endif;
    }

}
