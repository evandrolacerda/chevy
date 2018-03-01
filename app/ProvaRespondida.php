<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvaRespondida extends Model
{
    public $table = "prova_respondida";
    
    public function user() {
        return $this->belongsTo(\App\User::class);
    }
    
    public function prova() {
        return $this->belongsTo(\App\Prova::class);
    }
    
    public function respostas() {
        return $this->hasMany(\App\Resposta::class, 'prova_resp_id');
    }
}
