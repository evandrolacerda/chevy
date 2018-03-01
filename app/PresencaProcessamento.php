<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresencaProcessamento extends Model
{
    protected $table = "presenca_processamento";
    
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
}
