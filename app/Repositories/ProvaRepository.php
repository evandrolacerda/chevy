<?php

namespace App\Repositories;

/**
 * Description of ProvaRepository
 *
 * @author evandro
 */
class ProvaRepository {
    
    private $provaModel;
    
    
    public function __construct() {
        $this->provaModel = new \App\Prova();
    }

    
    public function provasRespondidas() {
        
    }
    
    public function provaBy($mes, $ano) {
        
    }
    
    public function all() {
        return $this->provaModel->all();
    }
    
    public function getAvailable($mes, $ano) {
        return $this->provaModel->latest()->first();
                /**->newQuery()
                ->where('mes', $mes)
                ->where('ano', $ano )
                ->orderBy('created_at', 'desc')
                ->first();
                 * 
                 */
    }
}
