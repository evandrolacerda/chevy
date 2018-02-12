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

    public function __construct(Prova $prova, User $user) {
        
        $this->user = $user;
        $this->prova = $prova;
        
        $this->respostas = [];
        
        $this->fetchRepostas();
    }

    private function fetchRepostas() {
        foreach ($this->prova->perguntas as $pergunta) {
            $resposta = Resposta::where('user_id', $this->user->id)
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
