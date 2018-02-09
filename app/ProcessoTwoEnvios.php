<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessoTwoEnvios extends Model {

    protected $table = 'envios_processo_two';

    public function processo() {
        return $this->belongsTo(\App\Processo::class);
    }


    public function user() {
        return $this->belongsTo(\App\User::class);
    }

}
