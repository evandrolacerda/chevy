<?php

namespace App\Repositories;

use App\QuantidadeEnviosVisitas;
use Illuminate\Support\Facades\Auth;

/**
 * Description of EnviosProcessoTwo
 *
 * @author evandro
 */
class EnviosProcessoTwoRepository {

    private $enviosModel;

    public function __construct() {
        $this->enviosModel = new \App\ProcessoTwoEnvios();
    }

    public function getCountFilesSent(int $userId, $month, $year) {

        $count = $this->enviosModel->newQuery()
                ->where('user_id', $userId)
                ->where('mes', $month)
                ->where('ano', $year)
                ->get()
                ->count();


        return $count;
    }

    public function getAlreadySent(int $userId, $month, $year) {

        $data = $this->enviosModel->newQuery()
                ->where('user_id', $userId)
                ->where('mes', $month)
                ->where('ano', $year)
                ->get();

        return $data;
    }

    public function getFilesRemaining(int $userId, $month, $year) {
        $quantidadesRole = $this->getQuantityPerRole();
        $enviados = $this->getCountFilesSent($userId, $month, $year);

        $remaining = $quantidadesRole - $enviados;

        return $remaining;
    }

    public function update($data) {
        $envio = \App\ProcessoTwoEnvios::find($data['id']);

        $envio->legenda = $data['local'];
        $envio->data = $data['data'];

        $envio->save();

        return $envio;
    }

    public function save($data) {
        $model = new \App\ProcessoTwoEnvios();
        $model->user_id = $data['user_id'];
        $model->mes = $data['mes'];
        $model->ano = $data['ano'];
        $model->processo_id = 2;
        $model->arquivo = 'storage/' . $data['path'];
        $model->thumbs_path = 'storage/thumbs/' . $data['path'];
        $model->save();

        return $model;
    }

    public function delete($id) {
        $envio = \App\ProcessoTwoEnvios::find($id);

        try {
            $envio->delete();
        } catch (\Exception $exc) {
            throw new \Exception($exc);
        }
    }
    
    
    public function find($id) {
        return \App\ProcessoTwoEnvios::find( $id );
    }
    
    public function getQuantityPerRole() {
        return QuantidadeEnviosVisitas::where('role_id', Auth::user()->role->id)
                        ->first()
                ->quantidade;
    }

    public function getAlbumsFrom(int $mes, int $ano, $userId = null){
        
        $query = $this->enviosModel->newQuery()
            ->where('mes', $mes)
            ->where('ano', $ano);
            

        if( $userId ){
            $query->where('user_id', $userId );
        }

        return $query->get();
               
    }

}
