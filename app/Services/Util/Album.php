<?php
namespace App\Services\Util;



class Album{
    private $service;

    public $user;

    private $mes;

    private $ano;
    
    private $fotos;
    

    public function __construct(int $user, int $mes, int $ano)
    {
        $this->service = new \App\Services\ProcessoTwoService();
        $this->user = \App\User::find($user);
        
        $this->ano = $ano;
        $this->mes = $mes;
        
        $this->fotos = $this->service->getAlreadySent($this->user->id, $mes, $ano);
    }

    
    public function getFotos() {
        return $this->fotos;
    }
    
    
    public function getCountFotos() {
        return $this->fotos->count();
    }

    public function getEnviosRepo() {
        return $this->service;
    }

    public function getUser() {
        return $this->user;
    }

    public function getMes() {
        return $this->mes;
    }

    public function getAno() {
        return $this->ano;
    }
    

    public function setUser($user) {
        $this->user = $user;
    }

    public function setMes($mes) {
        $this->mes = $mes;
    }

    public function setAno($ano) {
        $this->ano = $ano;
    }



}