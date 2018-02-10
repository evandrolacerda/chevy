<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormPlanilhaVisitasRequest;
use Illuminate\Support\Facades\Auth;
use App\Services\ProcessoOneService;

class ProcessoOneController extends Controller {

    private $processoService;
    private $month;
    private $year;

    public function __construct(ProcessoOneService $service) {
        $this->processoService = $service;
        $this->month = date('m');
        $this->year = date('Y');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $showFormMetas = $this->processoService
                        ->getPlanilhaMetas(
                                $this->month, $this->year, Auth::user())
                        ->count() === 0;
        
        
        $showFormVisitas = $this->processoService
                        ->getPlanilhaVisitas(
                                $this->month, $this->year, Auth::user()
                        )->count() === 0;



        return view('processo_one.index')->with(compact('showFormMetas', 'showFormVisitas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPlanilhaVisitasRequest $request) {
        $request->persist();

        return redirect('/planejamento')->with('status', 'Arquivo enviado com sucesso!');
    }

}
