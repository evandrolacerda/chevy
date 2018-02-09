<?php

namespace App\Chain;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VendedorChain
 *
 * @author evandro
 */
class VendedorChain extends \App\Chain\ProcessoChain{

    public function setNext(ProcessoChain $next) {
        $this->next = $next;
    }

    public function pontua(App\Processo $processo) {
        
    }

}
