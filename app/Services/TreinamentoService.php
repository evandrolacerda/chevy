<?php
namespace App\Services;

/**
 * Description of TreinamentoService
 *
 * @author evandro
 */
class TreinamentoService extends AbstractService {
   
    const PROCESSO_ID = 5;
    
    private $treinamentoRepo;
    
    
    public function __construct() {
        parent::__construct();
        $this->treinamentoRepo = new \App\Repositories\TreinamentoRepository();
        
    }
    
    public function isAvailableToAction(\App\User $user) {
        return in_array($user->role->id, $this->rolesParticipants);
    }

    public function shouldScore() {
        $user = \Illuminate\Support\Facades\Auth::user()->id;
        
        if( $this->treinamentoRepo->getAtaTreinamentoFor($user, $mes, $ano)){
            
        }
    }

}
