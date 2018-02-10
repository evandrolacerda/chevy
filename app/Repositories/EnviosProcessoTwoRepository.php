<?php

namespace App\Repositories;

use App\QuantidadeEnviosVisitas;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ArquivosRepository;
use App\Arquivo;


/**
 * Description of EnviosProcessoTwo
 *
 * @author evandro
 */
class EnviosProcessoTwoRepository {

    private $enviosModel;
    private $arquivoRepo;
    public function __construct() {
        $this->enviosModel = new \App\ProcessoTwoEnvios();
        $this->arquivoRepo = new \App\Repositories\ArquivosRepository();
    }

    

    

    

    public function update($data) {
        $envio = Arquivo::find($data['id']);

        $envio->legenda = $data['local'];
        $envio->data = $data['data'];

        $envio->save();

        return $envio;
    }
    
    

    public function save($data) {
        $model = new \App\Arquivo();
        $model->user_id = $data['user_id'];
        $model->mes     = $data['mes'];
        $model->ano     = $data['ano'];
        $model->processo_id = 2;
        $model->arquivo = 'storage/' . $data['path'];
        $model->thumbs_path = 'storage/thumbs/' . $data['path'];
        $model->save();

        return $model;
    }

    public function delete($id) {
        $envio = \App\Arquivo::find($id);

        try {
            $envio->delete();
        } catch (\Exception $exc) {
            throw new \Exception($exc);
        }
    }
    
    
    public function find($id) {
        return \App\Arquivo::find( $id );
    }
    
    

}
