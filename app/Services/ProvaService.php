<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Description of TreinamentoService
 *
 * @author evandro
 */
class ProvaService extends AbstractService {

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
            
            DB::beginTransaction();
            
            $provaAplicada = new \App\ProvaRespondida();
            $provaAplicada->prova_id = $data['prova_id'];
            $provaAplicada->user_id = Auth::user()->id;
            
            $provaAplicada->save();
            
            foreach ($data['questao'] as $key => $value) {
                $resposta = new \App\Resposta();

                
                $resposta->pergunta_id = $key;
                $resposta->resposta = $value;
                $resposta->prova_resp_id = $provaAplicada->id;

                $resposta->save();
            }
            
            $prova = \App\Prova::find( $data['prova_id']);
            $this->aplicacaoProva = new \App\Services\Util\AplicacaoProva($prova, Auth::user());
            
            

            $this->pontuar(
                    $prova->mes, $prova->ano, Auth::user()->id
            );
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
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
