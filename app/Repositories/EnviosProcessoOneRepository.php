<?php

namespace App\Repositories;

/**
 * Description of EnviosProcessoOneRepository
 *
 * @author evandro
 */
class EnviosProcessoOneRepository {

    private $processoOneEnvios;

    public function __construct(\App\ProcessoOneEnvios $processoOneEnvios) {
        $this->processoOneEnvios = $processoOneEnvios;
    }

    public function save($data) {
        try {
            $envio = \App\ProcessoOneEnvios::create($data);


            return $envio;
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }
    
    public function getPlanilhasVisitas($mes, $ano) {
        $planilhas = $this->processoOneEnvios->newQuery()
                ->where('mes', $mes)
                ->where('ano', $ano )
                ->where('tipo_arquivo_id', \App\Services\ProcessoOneService::FILE_PLANILHA_VISITAS )
                ->get();
        
        //dd( $this->processoOneEnvios::all());
        
        return $planilhas;
        
    }
    
    public function getPlanilhasMetas($mes, $ano) {
        $planilhas = $this->processoOneEnvios->newQuery()
                ->where('mes', $mes)
                ->where('ano', $ano )
                ->where('tipo_arquivo_id', \App\Services\ProcessoOneService::FILE_PLANILHA_METAS )
                ->get();
        
        return $planilhas;
        
    }

}
