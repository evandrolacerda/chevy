<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ProcessoOneService;
use App\Processo;
use App\Role;
use Illuminate\Support\Facades\Auth;


class FormPlanilhaMetasRequest extends FormRequest {

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
            'metas' => 'required'
        ];
    }

    public function persist() {
        try {
            if ($this->file('metas')->isValid()) {

                $this->validateExtension();

                $nomePlanilha = sprintf("%s.%s", md5(microtime() . 
                        Auth::user()->email . ProcessoOneService::FILE_PLANILHA_METAS), 
                        $this->file('metas')->getClientOriginalExtension());


                $this->file('metas')->storeAs('publi/metas/', $nomePlanilha);

                $data = [
                    'tipo_arquivo_id' => ProcessoOneService::FILE_PLANILHA_METAS,
                    'nome_arquivo' => $nomePlanilha,
                    'mes' => date('m'),
                    'ano' => date('Y'),
                    'user_id' => Auth::user()->id
                ];

                $this->service->save($data);

                
            } else {
                return back()->withErrors(['Arquivo inválido']);
            }
        } catch (\Exception $ex) {
            return back()->withErrors(['erro' => $ex->getMessage()]);
        }
    }

    private function validateExtension() {
        $acceptableExtensions = ['xls', 'xlsx', 'csv'];

        $extension = $this->file('metas')
                ->getClientOriginalExtension();

        if (!in_array($extension, $acceptableExtensions)) {
            return back()->withErrors(['erros' => 'Arquivo inválido']);
        }

        return true;
    }

}
