<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Backup extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_backup';

    protected $fillable = [
        'id_backup',
        'basedados',
        'usuario',
        'senha',
        'local',
        'agendamento'
    ];

        public function scopeIdbackup() {
        $backups = Backup::orderBy('id_backup', 'desc')->get();

        if ($backups->count() > 0):
            foreach ($backups as $backup):
                return $backup->id_backup + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
