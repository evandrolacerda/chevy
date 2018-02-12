<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Prova extends Model
{
    
    public function perguntas() {
        
        return $this->hasMany(\App\Pergunta::class);
                
    }
    
    public function user() {
        return $this->belongsTo(\App\User::class);
    }
    
}
