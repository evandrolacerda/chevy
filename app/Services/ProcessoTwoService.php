<?php

namespace App\Services;

use App\Repositories\ProcessoRepository;
use App\Services\Util\Calendar;
use App\Events\ScoreEvent;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Arquivo;
use App\QuantidadeEnviosVisitas;

/**
 * Description of ProcessoOneService
 *
 * @author evandro
 */
class ProcessoTwoService extends AbstractService {

    const PROCESSO_ID = 2;

    public function save(array $data) {
        if ($this->isAvailableToAction(Auth::user())) {

            try {
                $this->arquivosRepo->save($data);
            } catch (\Exception $ex) {
                throw new \Exception($ex);
            }
        }
    }

    /**
     * Verifica se o usuário logado pode efetuar a ação para o processo
     * Envio de arquivos somente no segundo dia útil
     * @param \App\User $user
     * @return boolean
     */
    public function isAvailableToAction(User $user) {

        //dd( $user->role->id, $this->rolesParticipants);
        if (in_array($user->role->id, $this->rolesParticipants)) {

            return true;
        }

        return false;
    }

    public function update($data) {
        try {


            $this->arquivosRepo->update($data, $data['id']);

            $mes = $this->getCompetencia()->format('m');
            $ano = $this->getCompetencia()->format('Y');
            $userId = Auth::user()->id;

            $this->pontuar($mes, $ano, $userId);
        } catch (\Exception $exc) {
            throw new \Exception($exc);
        }
    }

    public function shouldScore() {
        $mes = $this->getCompetencia()->format('m');
        $ano = $this->getCompetencia()->format('Y');
        $userId = Auth::user()->id;

        $countSent = $this->arquivosRepo->getArquivosBy(
                        $mes, $ano, Arquivo::FILE_FOTO_VISITA, $userId
                )->count();

        $allowed = QuantidadeEnviosVisitas::where('role_id', Auth::user()->role->id)
                        ->first()
                ->quantidade;

        if ($allowed - $countSent > 0) {
            return false;
        }


        $envios = $this->arquivosRepo->getArquivosBy($mes, $ano, Arquivo::FILE_FOTO_VISITA, $userId);


        foreach ($envios as $envio) {
            if ($envio->legenda == null || $envio->data == null) {
                return false;
            }
        }

        return true;
    }

    public function getCompetencia() {
        $mes = date('m');
        $ano = date('Y');

        $today = new \DateTimeImmutable();

        //$today = new \DateTimeImmutable( '2018-02-05' );

        $secondBussinessDay = Calendar::getAllBussinnesDayFrom($mes, $ano)[1];
        $secondBussinessDay->setTime(23, 59, 59);

        $competencia = new \DateTime();

        if ($today <= $secondBussinessDay) {
            $competencia->sub(new \DateInterval('P1M'));
        }



        return $competencia;
    }

    public function delete($id) {

        try {

            $envio = $this->arquivosRepo->find($id);

            //dd(str_after($envio->thumbs_path, 'storage'));
            Storage::delete('public/' . str_after($envio->thumbs_path, 'storage'));

            Storage::delete('public/' . str_after($envio->arquivo, 'storage'));

            //deleta os pontos se houver
            $pontos = \App\Pontuacao::where('user_id', $envio->user_id)
                    ->where('mes', $envio->mes)
                    ->where('ano', $envio->ano)
                    ->where('processo_id', $envio->processo_id)
                    ->first();


            if ($pontos !== null) {
                $pontos->delete();
            }

            //deleta o envio do banco de dados
            $this->arquivosRepo->delete($id);
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }

    public function getCountFilesSent(int $userId, $month, $year) {

        return $this->arquivosRepo
                        ->getArquivosBy(
                                $month, $year, Arquivo::FILE_FOTO_VISITA, $userId)
                        ->count();
    }

    public function getAlreadySent(int $userId, $month, $year) {

        $data = $this->arquivosRepo->getArquivosBy($month, $year, Arquivo::FILE_FOTO_VISITA, $userId);

        return $data;
    }

    public function getFilesRemaining(int $userId, $month, $year) {
        $quantidadesRole = $this->getQuantityPerRole();
        $enviados = $this->getCountFilesSent($userId, $month, $year);

        $remaining = $quantidadesRole - $enviados;

        return $remaining;
    }

    public function getQuantityPerRole() {
        return QuantidadeEnviosVisitas::where('role_id', Auth::user()->role->id)
                        ->first()
                ->quantidade;
    }

    public function getAlbumsFrom(int $mes, int $ano, $userId = null) {

        $query = $this->enviosModel->newQuery()
                ->where('mes', $mes)
                ->where('ano', $ano);


        if ($userId) {
            $query->where('user_id', $userId);
        }

        return $query->get();
    }

}
