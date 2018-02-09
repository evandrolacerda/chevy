<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    
    public function prova() {
        return $this->belongsToMany(\App\Prova::class, 'prova_perguntas')->withPivot('resposta');
    }
    
    public function processo()
    {
        return $this->belongsTo(\App\Processo::class);
    }
}
