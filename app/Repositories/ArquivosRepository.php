<?php

namespace App\Repositories;

/**
 * Description of ArquivosRepository
 *
 * @author evandro
 */
class ArquivosRepository {

    private $arquivosModel;

    public function __construct() {
        $this->arquivosModel = new \App\Arquivo();
    }

    public function getArquivosBy($mes, $ano, $tipo, $user = null) {
        $query = $this->arquivosModel
                ->newQuery()
                ->where('ano', $ano)
                ->where('mes', $mes)
                ->where('tipo_arquivo_id', $tipo);

        if ($user) {
            $query->where('user_id', $user);
        }


        return $query->get();
    }

    public function save(array $data) {
        try {
            $envio = \App\Arquivo::create($data);


            return $envio;
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
    }

    public function find($id) {
        return $this->arquivosModel->find($id);
    }

    public function update(array $data, int $id) {
        $arquivo = $this->arquivosModel->find($id);



        $data['updated_at'] = \Carbon\Carbon::now();
        $arquivo->update($data);
    }

    public function delete($id) {
        try {
            $arquivo = $this->find($id);


            $arquivo->delete();
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }

}
