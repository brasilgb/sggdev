<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_email';

    protected $fillable = [
        'id_email',
        'smtp',
        'porta',
        'seguranca',
        'usuario',
        'senha',
        'remetente',
        'destinatario',
        'assunto',
        'mensagem'
    ];

        public function scopeIdemail() {
        $emails = Email::orderBy('id_email', 'desc')->get();

        if ($emails->count() > 0):
            foreach ($emails as $email):
                return $email->id_email + 1;
            endforeach;
        else:
            return 1;
        endif;
    }
}
