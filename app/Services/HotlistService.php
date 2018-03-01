<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

/**
 * Description of HotlistService
 *
 * @author evandro
 */
class HotlistService extends AbstractService{
    
    private $meta;
    private $atingido;

    const PROCESSO_ID = 3;

    public function isAvailableToAction(\App\User $user) {
        
        return in_array($user->role->id, $this->rolesParticipants);
    }

    
    public function save(array $data) {
        
        $this->atingido = $data['atingido'];
        $this->meta = $data['meta'];
        
        
        try{
            $user = \App\User::find( $data['user_id']);
                
            if( $this->isAvailableToAction($user))
            {
                $this->pontuar( $data['mes'], $data['ano'], $data['user_id'] );
                
                
                $processamento = new \App\HotlistProcessamento();
                $processamento->mes = $data['mes'];
                $processamento->ano = $data['ano'];
                $processamento->user_id = $data['user_id'];
                $processamento->meta = $data['meta'];
                $processamento->atingido = $data['atingido'];
                
                $processamento->save();
                
            }
            
            
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }
    public function shouldScore() {
        return $this->atingido >= $this->meta;
    }

}
