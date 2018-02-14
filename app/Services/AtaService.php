<?php

namespace App\Services;

use App\Arquivo;
use App\Services\Util\Calendar;
use Illuminate\Support\Facades\Auth;

/**
 * Description of AtaService
 *
 * @author evandro
 */
class AtaService extends AbstractService {
    
    const PROCESSO_ID = 5;

    public function isAvailableToAction(\App\User $user) {
        return in_array($user->role->id, $this->rolesParticipants);
    }

    public function shouldScore() {
        
        $mes = $this->getCompetencia()->format('m');
        $ano = $this->getCompetencia()->format('Y');
        
        $ata = $this->isAtaSent( $mes, $ano, Auth::user()->id );
        $foto = $this->isFotoSent( $mes, $ano, Auth::user()->id );
        
        //dd($ata, $foto);
        return ( $foto && $ata );
    }

    public function save(array $data) {
        if ($this->isAvailableToAction(Auth::user())) {

            try {
                
                $this->arquivosRepo->save($data);
                $this->pontuar($data['mes'], $data['ano'], $data['user_id']);
                
            } catch (\Exception $ex) {
                throw new \Exception($ex);
            }
        }
    }
    
    
    public function isAtaSent($mes, $ano, $userId) {
        $reg =$this->arquivosRepo
                ->getArquivosBy($mes, $ano, Arquivo::FILE_ATA_TREINAMENT0, $userId);
        
        //dd($reg);
        return ( $reg->count() > 0 );
    }
    
    public function isFotoSent($mes, $ano, $userId) {
        $reg =$this->arquivosRepo
                ->getArquivosBy($mes, $ano, Arquivo::FILE_FOTO_TREINAMENTO, $userId);
        
        //dd( $reg );
        return ( $reg->count() > 0 );
    }
    
    
    public function getCompetencia() {
        $mes = date('m');
        $ano = date('Y');

        $today = new \DateTimeImmutable();

        //$today = new \DateTimeImmutable( '2018-02-05' );

        $secondBussinessDay = Calendar::getAllBussinnesDayFrom($mes, $ano)[1];
        $secondBussinessDay->setTime(23, 59, 59);

        $competencia = new \DateTime();

        if ($today <= $secondBussinessDay) {
            $competencia->sub(new \DateInterval('P1M'));
        }

        return $competencia;
    }
    
    public function fetchAta($mes, $ano, $user) {
        return $this->arquivosRepo
                ->getArquivosBy($mes, $ano, Arquivo::FILE_ATA_TREINAMENT0, $user);
        
        
    }
    
    
    public function fetchFoto($mes, $ano, $user) {
        return $this->arquivosRepo
                ->getArquivosBy($mes, $ano, Arquivo::FILE_FOTO_TREINAMENTO, $user);
    }
    
    
    public function showFormAta($mes, $ano, $user ) {
        return $envioArquivo = $this->fetchAta($mes, $ano, $user)->count() === 0;
    }
    
    public function showFormFoto($mes, $ano, $user) {
        return $this->fetchFoto($mes, $ano, $user)->count() === 0;
    }
    

}
