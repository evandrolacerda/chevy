<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuantidadeEnviosVisitas extends Model
{
    protected $table = 'quant_envios_processo_two';
    
    public function role() {
        return $this->hasOne(\App\Role::class);
    }
}
