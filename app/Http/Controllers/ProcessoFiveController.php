<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleInterface;
use Illuminate\Support\Facades\Auth;


class ProcessoFiveController extends Controller {

    private $provasRepo;
    private $service;
    
    public function __construct() {
        $this->provasRepo = new \App\Repositories\ProvaRepository(); 
        $this->service = new \App\Services\TreinamentoService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (in_array(Auth::user()->role->id, [
                    RoleInterface::DIRETOR_VENDAS,
                    //RoleInterface::GERENTE_VENDAS
                ])) {
            return view('processo_five.ata');
        }
        $mes = date('m');
        $ano = date('Y');
        
        $prova = $this->provasRepo->getAvailable( $mes, $ano );
        
        $applicacaoProva = new \App\Services\Util\AplicacaoProva($prova, Auth::user() );
        
        
        
        return view('processo_five.prova', ['prova' => $applicacaoProva]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        
        $this->validate($request, [
            'questao.*' => 'required'
        ]);
        
        $this->service->save($request->all());
        
        return back()->with('status', 'Prova salva');
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function ata(Request $request) {
        
    }

}
