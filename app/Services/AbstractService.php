<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Processo;


/**
 * Description of AbstractService
 *
 * @author evandro
 */
abstract class AbstractService {

    protected $processoRepo;
    protected $enviosProcessoRepo;
    protected $rolesParticipants;
    protected $currentMonth;
    protected $currentYear;

    public function __construct() {

        $this->currentMonth = date('m');
        $this->currentYear = date('Y');

        $this->processoRepo = new \App\Repositories\ProcessoRepository(new \App\Processo(), new \App\Role());
        
        $this->rolesParticipants = $this->getRolesParticipants(static::PROCESSO_ID);
        
       
    }

    /**
     * Retorna a pontuação do Processo para a role
     * @param Role $role
     * @return type
     */
    public function getPointsFor(Role $role) {
        $processo = Processo::find(static::PROCESSO_ID);

        $pontos = 0;

        foreach ($processo->roles as $r) {
            if ($r->id === $role->id) {
                $pontos = $r->pivot->pontos;
            }
        }
        return $pontos;
    }

    public function getRolesParticipants($processoId) {
        $processo = Processo::find($processoId);

        return array_column($processo->roles->toArray(), 'id');
    }

    public abstract function shouldScore();

    protected function pontuar( int $mes, int $ano, int $userId ) {

        if ($this->shouldScore()) {
            try {
                $user = \App\User::find($userId);
                $pontuacao = new \App\Pontuacao();

                $pontuacao->pontos = $this->getPointsFor($user->role);

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

    public abstract function isAvailableToAction(User $user);
}
