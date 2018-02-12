<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

/**
 * Description of TreinamentoService
 *
 * @author evandro
 */
class TreinamentoService extends AbstractService {

    const PROCESSO_ID = 5;

    private $treinamentoRepo;
    
    private $aplicacaoProva;

    public function __construct() {
        parent::__construct();
        $this->treinamentoRepo = new \App\Repositories\TreinamentoRepository();
    }

    public function save(array $data) {
        if (!$this->isAvailableToAction(Auth::user())) {
            return back()->withErrors(['Você não tem autorização para efetuar esta acão']);
        }

        
        try {

            foreach ($data['questao'] as $key => $value) {
                $resposta = new \App\Resposta();

                $resposta->user_id = Auth::user()->id;
                $resposta->pergunta_id = $key;
                $resposta->resposta = $value;

                $resposta->save();
            }
            
            $prova = \App\Prova::find( $data['prova_id']);
            $this->aplicacaoProva = new \App\Services\Util\AplicacaoProva($prova, Auth::user());
            

            $this->pontuar(
                    $prova->mes, $prova->ano, Auth::user()->id
            );
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }

    public function isAvailableToAction(\App\User $user) {
        return in_array($user->role->id, $this->rolesParticipants);
    }

    public function shouldScore() {
         return $this->aplicacaoProva->isComplete();
    }

}
