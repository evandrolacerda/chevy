<?php

namespace App\Services;

use App\Repositories\ProcessoRepository;
use App\Services\Util\Calendar;
use App\Events\ScoreEvent;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
/**
 * Description of ProcessoOneService
 *
 * @author evandro
 */
class ProcessoTwoService extends AbstractService {

    const PROCESSO_ID = 2;

    protected $enviosProcessoRepo;

    public function __construct() {
        parent::__construct();

        $this->enviosProcessoRepo = new \App\Repositories\EnviosProcessoTwoRepository();
    }

    public function save(array $data) {
        if ($this->isAvailableToAction(Auth::user())) {

            try {
                $this->enviosProcessoRepo->save($data);

            } catch (\Exception $ex) {
                throw new \Exception($ex);
            }
        }
    }

    /**
     * Verifica se o usuário logado pode efetuar a ação para o processo
     * Envio de arquivos somente no segundo dia útil
     * @param \App\User $user
     * @return boolean
     */
    public function isAvailableToAction(User $user) {

        //dd( $user->role->id, $this->rolesParticipants);
        if (in_array($user->role->id, $this->rolesParticipants)) {

            return true;
        }

        return false;
    }

    public function update($data) {
        try {
            $this->enviosProcessoRepo->update($data);

            $mes = $this->getCompetencia()->format('m');
            $ano = $this->getCompetencia()->format('Y');
            $userId = Auth::user()->id;

            $this->pontuar($mes, $ano, $userId);
        } catch (\Exception $exc) {
            throw new \Exception($exc);
        }
    }

    public function shouldScore() {
        $mes = $this->getCompetencia()->format('m');
        $ano = $this->getCompetencia()->format('Y');
        $userId = Auth::user()->id;

        if( $this->enviosProcessoRepo->getFilesRemaining($userId, $mes, $ano) > 0 )
        {
            return false;
        }
        
        
        $envios = $this->enviosProcessoRepo->getAlreadySent($userId, $mes, $ano );
        
        
        foreach ( $envios as $envio )
        {
            if( $envio->legenda == null || $envio->data == null ){
                return false;
            }
        }
        
        return true;
    }

    public function getCompetencia() {
        $mes = date('m');
        $ano = date('Y');

        $today = new \DateTimeImmutable();

        //$today = new \DateTimeImmutable( '2018-02-05' );

        $secondBussinessDay = Calendar::getAllBussinnesDayFrom($mes, $ano)[1];
        $secondBussinessDay->setTime(23, 59, 59);

        $competencia = new \DateTime();

        if ( $today <= $secondBussinessDay ) {
            $competencia->sub( new \DateInterval('P1M') );
        }
        
        

        return $competencia;
    }
    
    public function delete($id) {
        
        try{
            $envio = $this->enviosProcessoRepo->find( $id );
            
            //dd(str_after($envio->thumbs_path, 'storage'));
        Storage::delete('public/' . str_after($envio->thumbs_path, 'storage'));
        
            Storage::delete('public/' . str_after($envio->arquivo, 'storage'));
            
            //deleta os pontos se houver
            $pontos = \App\Pontuacao::where('user_id', $envio->user_id)
                    ->where('mes', $envio->mes)
                    ->where('ano', $envio->ano)
                    ->where('processo_id', $envio->processo->id )
                    ->first();
            
            if( $pontos !== null ){
                $pontos->delete();
            }
            
            //deleta o envio do banco de dados
            $this->enviosProcessoRepo->delete($id);
            
            
            
        } catch (\Exception $ex) {
            throw new \Exception( $ex );
        }
    }

}
