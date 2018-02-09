<?php
namespace App\Chain;

/**
 * Description of VendedorProcessoHandler
 *
 * @author evandro
 */
class VendedorProcessoHandler extends \App\Chain\ProcessoChain{
    
    
    public function __construct( ) {
        $this->roleToEvaluate = \App\RoleInterface::VENDEDOR;
                 
    }


    public function pontua(App\Processo $processo) {
        
    }

}
