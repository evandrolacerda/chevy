<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    public $table = 'perguntas_respostas';
    
    public function pergunta() {
        return $this->belongsTo(\App\Pergunta::class);
    }
    
}
