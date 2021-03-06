<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pergunta extends Model
{
    public $fillable = [
      'pergunta'  
    ];
    
    public function prova() {
        return $this->belongsTo(\App\Prova::class);
    }
    
}
