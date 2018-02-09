<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoArquivo extends Model
{
    protected $table = 'tipos_arquivos';
    
    public $timestamps = false;


    public function processo()
    {
        return $this->belongsTo(\App\Processo::class);
    }
}
