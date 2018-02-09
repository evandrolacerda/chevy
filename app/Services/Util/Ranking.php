<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services\Util;

/**
 * Description of Rankin
 *
 * @author evandro
 */
class Ranking {
    
    private $usuario;
    private $processoOne;
    private $processoTwo;
    private $processoThree;
    private $processoFour;
    private $processoFive;
    private $metas;


    public function __construct() {
        $this->metas = 0;
    }
    
    
    public function getUsuario() {
        return $this->usuario;
    }

    public function getProcessoOne() {
        return $this->processoOne;
    }

    public function getProcessoTwo() {
        return $this->processoTwo;
    }

    public function getProcessoThree() {
        return $this->processoThree;
    }

    public function getProcessoFour() {
        return $this->processoFour;
    }

    public function getProcessoFive() {
        return $this->processoFive;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setProcessoOne($processoOne) {
        $this->processoOne = $processoOne;
    }

    public function setProcessoTwo($processoTwo) {
        $this->processoTwo = $processoTwo;
    }

    public function setProcessoThree($processoThree) {
        $this->processoThree = $processoThree;
    }

    public function setProcessoFour($processoFour) {
        $this->processoFour = $processoFour;
    }

    public function setProcessoFive($processoFive) {
        $this->processoFive = $processoFive;
    }

    public function getMetas() {
        return $this->metas;
    }

    public function setMetas($metas) {
        $this->metas = $metas;
    }

    public function getTotal() {
        $total = $this->getProcessoOne() + $this->getProcessoTwo() + $this->getProcessoThree()
                + $this->getProcessoFour() + $this->getProcessoFive();
        
        return $total + $this->getMetas();
    }

}
