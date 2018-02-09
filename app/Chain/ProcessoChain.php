<?php

namespace App\Chain;

/**
 * Description of ProcessoChain
 *
 * @author evandro
 */
abstract class ProcessoChain {

    /**
     *
     * @var type ProcessHandler
     * Próxima classe a ser avaliada na cadeia
     */
    protected $next;
    
    /**
     *
     * @var type int role id a ser avaliada pela classe
     */
    protected $roleToEvaluate;
    
    /**
     *
     * @var type int id do processo a ser avaliado
     */
    protected  $processToEvaluate;
    /**
     * 
     * @param type $role
     * @param type $processo
     */    
    public function __construct( $role, $processo ) {
        $this->roleToEvaluate = $role;
        $this->processToEvaluate = $processo;
        
    }

    /*
     * @role a ser avaliado pela classe
     */

    public function handle(App\Processo $processo) {
        
        if ($processo->user->role->id == $this->roleToEvaluate
                && $processo->id === $this->processToEvaluate ) {
            $this->pontua($processo);
        } else {
            if ($this->next == null) {
                throw new Exception("Não há pontuadores para a função");
            }
            $this->next->pontua($processo);
        }
        
    }

    public function setNext(ProcessoChain $next) {
        $this->next = $next;
    }

    abstract public function pontua(App\Processo $processo);
}
