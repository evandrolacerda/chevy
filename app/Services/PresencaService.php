<?php

namespace App\Services;

namespace App\Services;

/**
 * Description of PresencaService
 *
 * @author evandro
 */
class PresencaService extends AbstractService {

    private $user;
    private $pontosTotal = 0;
    
    const PROCESSO_ID = 4;

    public function isAvailableToAction(\App\User $user) {
        return in_array($user->role->id, $this->rolesParticipants);
    }

    public function save(array $data) {

        $user = \App\User::find($data['user_id']);
        $this->pontosTotal += $this->getPointsForGeral($user, $data['geral']);
        $this->pontosTotal += $this->getPointsForGranpure($user, $data['granpure']);
        $this->pontosTotal += $this->getPointsForSense($user, $data['sense']);


        try {

            if ($this->isAvailableToAction($user)) {
                $this->pontuar($data['mes'], $data['ano'], $data['user_id']);


                $processamento = new \App\PresencaProcessamento();
                $processamento->mes = $data['mes'];
                $processamento->ano = $data['ano'];
                $processamento->user_id = $data['user_id'];
                $processamento->indice_granpure = $data['granpure'];
                $processamento->indice_sense = $data['sense'];
                $processamento->indice_geral = $data['geral'];

                $processamento->save();
            }
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }
    
    
    protected function pontuar( int $mes, int $ano, int $userId ) {

        if ($this->shouldScore()) {
            try {
                //$user = \App\User::find($userId);
                $pontuacao = new \App\Pontuacao();

                $pontuacao->pontos = $this->pontosTotal;

                $pontuacao->user_id = $userId;
                $pontuacao->processo_id = static::PROCESSO_ID;
                $pontuacao->mes = $mes;
                $pontuacao->ano = $ano;

                $pontuacao->save();

                event(new \App\Events\ScoreEvent($pontuacao));
            } catch (\Exception $exc) {
                throw new \Exception($exc);
            }
        }
    }

    public function shouldScore() {
        return $this->pontosTotal > 0;
    }

    private function getPointsForSense(\App\User $user, $indice) {
        if ($indice >= 80) {
            return $this->getPointsFor($user->role) * 0.25;
        }
    }

    private function getPointsForGranpure(\App\User $user, $indice) {
        if ($indice >= 80) {
            return $this->getPointsFor($user->role) * 0.25;
        }
    }

    private function getPointsForGeral(\App\User $user, $indice) {
        if ($indice >= 80) {
            return $this->getPointsFor($user->role) * 0.5;
        }
    }

}
