<?php

namespace App\Services\Util;

use App\User;
use App\Prova;
use App\Resposta;

/**
 * Description of AplicacaoProva
 *
 * @author evandro
 */
class AplicacaoProva {

    public $perguntas;
    public $prova;
    public $respostas;
    public $user;
    public $provaRespondida;

    public function __construct(Prova $prova, User $user) {
        
        $this->user = $user;
        $this->prova = $prova;
        $this->provaRespondida = \App\ProvaRespondida::where('user_id', $user->id)
                ->where('prova_id', $this->prova->id)
                ->first();
        
        $this->respostas = [];
        
        $this->fetchRepostas();
    }

    private function fetchRepostas() {
        if( $this->provaRespondida === null ){
            return;
        }
        
        foreach ($this->prova->perguntas as $pergunta) {
            $resposta = Resposta::where('prova_resp_id', $this->provaRespondida->id)
                    ->where('pergunta_id', $pergunta->id)
                    ->first();
            
            if( $resposta !== null )
            {
                $this->respostas[$pergunta->id] = $resposta;
            }
        }
    }
    
    public function isComplete() {
        return count( $this->respostas ) > 0 && (count( $this->respostas) === $this->prova->perguntas->count());
    }
    
    

}
