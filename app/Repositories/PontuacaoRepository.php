<?php

namespace App\Repositories;

use App\Pontuacao;

/**
 * Description of PontuacaoRepository
 *
 * @author evandro
 */
class PontuacaoRepository {

    private $pontuacaoModel;

    public function __construct() {
        $this->pontuacaoModel = new Pontuacao();
    }

    public function history(int $userId, $mes, $ano) {

        $historyAtual = $this->pontuacaoModel->newQuery()
                ->where('user_id', $userId)
                ->where('ano', $ano)
                ->where('mes', $mes)
                ->where('invalidado', 0)
                ->get();

        return $historyAtual;
    }

    public function ranking($mes, $ano) {
        $users = \App\User::where('ativo', 1)->where('role_id', '!=', 5)->get();


        $history = [];

        foreach ($users as $user) {
            $ranking = new \App\Services\Util\Ranking();

            $ranking->setUsuario($user);

            $processoOne = $this->getPontosFor($user->id, 1, $mes, $ano);
            $processoTwo = $this->getPontosFor($user->id, 2, $mes, $ano);
            $processoThree = $this->getPontosFor($user->id, 3, $mes, $ano);
            $processoFour = $this->getPontosFor($user->id, 4, $mes, $ano);
            $processoFive = $this->getPontosFor($user->id, 5, $mes, $ano);

            $ranking->setProcessoOne($processoOne);
            $ranking->setProcessoTwo($processoTwo);
            $ranking->setProcessoThree($processoThree);
            $ranking->setProcessoFour($processoFour);
            $ranking->setProcessoFive($processoFive);

            $history[] = $ranking;
        }

        return collect($history);
    }

    /**
     * 
     * @param type $userId
     * @param type $processoId
     * @param type $mes
     * @param type $ano
     * @return int retorna os pontos
     */
    public function getPontosFor($userId, $processoId, $mes, $ano) {
        $pontos = \App\Pontuacao::where('user_id', $userId)
                ->where('processo_id', $processoId)
                ->where('mes', $mes)
                ->where('ano', $ano)
                ->where('invalidado', 0)
                ->first();

        if ($pontos === null) {
            return 0;
        }

        return $pontos->pontos;
    }

    /*
     * 
     */

    public function getPontuacaoFor($userId, $processoId, $mes, $ano) {
        return \App\Pontuacao::where('user_id', $userId)
                        ->where('processo_id', $processoId)
                        ->where('mes', $mes)
                        ->where('ano', $ano)
                        ->where('invalidado', 0)
                        ->first();
    }
    
    public function find($id) {
        return $this->pontuacaoModel->find($id);
    }

}
