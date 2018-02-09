<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Prova extends Model
{
    
    public function perguntas() {
        
        return $this->belongsToMany(\App\Pergunta::class, 'prova_perguntas')
                ->withPivot('resposta');
    }
    
    public function user() {
        return $this->belongsTo(\App\User::class);
    }
    
}
