<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pontuacao extends Model
{
    protected $table = 'pontuacoes';
    
    public function user() {
        return $this->belongsTo(\App\User::class);
    }
    
    public function processo() {
        return $this->belongsTo(\App\Processo::class);
    }
}
