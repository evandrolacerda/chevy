<?php

namespace App\Repositories;

/**
 * Description of TreinamentoRepository
 *
 * @author evandro
 */
class TreinamentoRepository {
    
    const ARQUIVO_ATA_TREINAMENTO_ID = 5;
    const ARQUIVO_FOTO_TREINAMENTO_ID = 6;

    private $enviosProcessoFiveModel;
    
    
    public function __construct() {
        $this->enviosProcessoFiveModel = new \App\EnviosProcessoFive();
    }
    
    public function getAtaTreinamentoFor($user, $mes, $ano) {
        return $this->enviosProcessoFiveModel
                ->newQuery()
                ->where('user_id', $user)
                ->where('mes', $mes)
                ->where('ano', $ano )
                ->where('tipo_arquivo_id',self::ARQUIVO_ATA_TREINAMENTO_ID )->first();
    }
    
    public function getFotoTreinamentoFor($user, $mes, $ano) {
        return $this->enviosProcessoFiveModel
                ->newQuery()
                ->where('user_id', $user)
                ->where('mes', $mes)
                ->where('ano', $ano )
                ->where('tipo_arquivo_id', 6 )->get();
    }
    
}
