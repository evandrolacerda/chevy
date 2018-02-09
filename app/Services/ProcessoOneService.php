<?php

namespace App\Services;

use App\Pontuacao;
use App\ProcessoOneEnvios;
use App\Repositories\EnviosProcessoOneRepository;
use App\Services\Util\Calendar;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;

/**
 * Description of ProcessoOneService
 *
 * @author evandro
 */
class ProcessoOneService extends AbstractService {

    /**
     *
     * @var type \App\Repositories\ProcessoRepository
     */
    const PROCESSO_ID = 1;
    const FILE_PLANILHA_VISITAS = 1;
    const FILE_PLANILHA_METAS = 2;
    const FILE_TYPES = [
        self::FILE_PLANILHA_VISITAS => 'Planilha Sistemática de Visitas',
        self::FILE_PLANILHA_METAS => 'Planiha Desdobramento de Metas'
    ];

    public function __construct() {
        
        parent::__construct();
        
        $this->enviosProcessoRepo = new EnviosProcessoOneRepository(
                new ProcessoOneEnvios()
        );
    }

    public function save(array $data) {
        if ($this->isAvailableToAction(Auth::user())) {

            try {
                $this->enviosProcessoRepo->save($data);

                $this->pontuar( $this->currentMonth, $this->currentYear, Auth::user()->id );
            } catch (\Exception $ex) {
                throw new \Exception($ex);
            }
        }
    }

    public function shouldScore() {
        if ($this->getPlanilhaMetas($this->currentMonth, $this->currentYear, 
                Auth::user())->count() > 0 && $this->getPlanilhaVisitas(
                        $this->currentMonth, 
                        $this->currentYear, 
                        Auth::user())->count() > 0) {
            $pontuacao = Pontuacao::where('mes', $this->currentMonth)
                    ->where('ano', $this->currentYear)
                    ->where('user_id', Auth::user()->id)
                    ->where('processo_id', self::PROCESSO_ID)
                    ->get();

            //dd( $pontuacao   );
            if ($pontuacao->count() === 0) {
                return true;
            }

            return false;
        }

        return false;
    }

    /**
     * Verifica se o usuário logado pode efetuar a ação para o processo
     * Envio de arquivos somente no segundo dia útil
     * @param User $user
     * @return boolean
     */
    public function isAvailableToAction(User $user) {

        $initialDate = Carbon::create($this->currentYear, $this->currentMonth, 01);

        //processo pode ser realizado até o segundo dia útil do mês
        $limitDate = Calendar::getAllBussinnesDayFrom($this->currentMonth, $this->currentYear)[1];


        //$today = Carbon::create('2018', '01', '04');
        $today = \Carbon\Carbon::now();
        //dd( $user->role->id, $this->rolesParticipants);
        if (in_array($user->role->id, $this->rolesParticipants) && ( $today >= $initialDate && $today <= $limitDate )) {

            return true;
        }

        return false;
    }

    public function getPlanilhaMetas(int $month, int $year, User $user) {
        $envios = ProcessoOneEnvios::where('tipo_arquivo_id', self::FILE_PLANILHA_METAS)
                ->where('user_id', $user->id)
                ->where('mes', $month)
                ->where('ano', $year);

        return $envios->get();
    }

    public function getPlanilhaVisitas(int $month, int $year, User $user) {
        $envios = ProcessoOneEnvios::where('tipo_arquivo_id', self::FILE_PLANILHA_VISITAS)
                ->where('user_id', $user->id)
                ->where('mes', $month)
                ->where('ano', $year);

        return $envios->get();
    }

}
