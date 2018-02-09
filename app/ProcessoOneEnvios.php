<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessoOneEnvios extends Model
{
    protected $table = 'envios_processo_one';
    
    public $fillable = [
        'nome_arquivo',
        'mes',
        'ano',
        'user_id',
        'tipo_arquivo_id'
    ];


    public function processo()
    {
        return $this->belongsTo(\App\Processo::class);
    }
    
    public function arquivo()
    {
        return $this->hasOne(\App\TipoArquivo::class);
    }
    
    public function user() {
        return $this->belongsTo( \App\User::class );
    }
    
    
}
