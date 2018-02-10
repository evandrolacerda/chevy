<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    const FILE_PLANILHA_VISITAS = 1;
    const FILE_PLANILHA_METAS = 2;
    const FILE_ATA_TREINAMENT0 = 3;
    const FILE_FOTO_TREINAMENTO = 4;
    const FILE_FOTO_VISITA = 5;
    
    
    const FILE_TYPES = [
        self::FILE_PLANILHA_VISITAS => 'Planilha Sistemática de Visitas',
        self::FILE_PLANILHA_METAS => 'Planiha Desdobramento de Metas'
    ];
    
    public $fillable = [
        'arquivo',
        'mes',
        'ano',
        'user_id',
        'tipo_arquivo_id',
        'processo_id',
        'legenda',
        'data',
        'thumbs_path'
        
    ];
    
    public function user() {
        return $this->belongsTo(\App\User::class );
    }
}
