<?php
namespace App\Repositories;


/**
 * Description of ProcessoRepository
 *
 * @author evandro
 */
class ProcessoRepository {
    private $processoModel;
    private $roleModel;




    public function __construct(\App\Processo $processo, \App\Role $role  ) {
        $this->processoModel = $processo;
        $this->roleModel = $role;
                 
    }
    
    public function getProcessosForRole(\App\Role $role )
    {
        return $this->roleModel->find( $role->id )->processos;
    }

}
