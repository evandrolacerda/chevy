<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ProcessoOneService;
use Illuminate\Support\Facades\Auth;
use App\Arquivo;
use App\Role;
use App\Processo;

class FormPlanilhaVisitasRequest extends FormRequest {

    private $repo;
    private $service;

    public function __construct() {

        parent::__construct();

        $this->repo = new \App\Repositories\ProcessoRepository(new Processo(), new Role());
        $this->service = new ProcessoOneService($this->repo);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

        $rolesAuthorized = $this->service->getRolesParticipants(1);

        return in_array(Auth::user()->role->id, $rolesAuthorized);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'visitas' => 'required'
        ];
    }

    public function persist() {
        try {
            if (!$this->file('visitas')->isValid()) {
                return back()->withErrors(['Arquivo inválido']);
            }

            $this->validateExtension();

            $nomePlanilha = sprintf("%s.%s", md5(microtime() . 
                        Auth::user()->email . 
                        Arquivo::FILE_PLANILHA_VISITAS), 
                        $this->file('visitas')->getClientOriginalExtension()
                    );


            $this->file('visitas')->storeAs('public/visitas/', $nomePlanilha);

            $data = [
                'tipo_arquivo_id' => Arquivo::FILE_PLANILHA_VISITAS,
                'arquivo' => $nomePlanilha,
                'mes' => date('m'),
                'ano' => date('Y'),
                'user_id' => Auth::user()->id,
                'processo_id' => 2
                
            ];

            $this->service->save($data);

        } catch (\Exception $ex) {
            return back()->withErrors(['erro' => $ex->getMessage()]);
        }
    }

    private function validateExtension() {
        $acceptableExtensions = ['xls', 'xlsx', 'csv'];

        $extension = $this->file('visitas')
                ->getClientOriginalExtension();

        if (!in_array($extension, $acceptableExtensions)) {
            return back()->withErrors(['erros' => 'Arquivo inválido']);
        }

        return true;
    }

}
