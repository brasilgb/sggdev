<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_checklist';
//    public $incrementing = false;
    protected $fillable = [
        'periodo',
        'mes',
        'data_inicial',
        'data_final',
        'check'
    ];
}
