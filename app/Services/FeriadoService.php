<?php
namespace App\Services;

class FeriadoService{

    private $feriadoModel;

    public function __construct()
    {
        $this->feriadoModel = new \App\Feriado();
    }

    public function save($request)
    {
        try{
            $feriado = new \App\Feriado();

            $feriado->data = \Carbon\Carbon::parse($request['data']);
            $feriado->tipo = \App\Feriado::TIPOS_FERIADOS[$request['tipo']];
            $feriado->nome = $request['nome'];
            $feriado->codigo_tipo = $request['tipo'];

            $feriado->save();

        }catch(\Exception $e ){
            throw new \Exception($e);
        }    
        
    }


}