<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvasAplicadasController extends Controller
{
    
    private  $provasRepo;
    
    
    public function __construct() {
        $this->provasRepo = new \App\Repositories\ProvaRepository();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mes = date('m');
        $ano = date('Y');
        
        $ultimaProva = $this->provasRepo->getAvailable($mes, $ano);
        
        $provasAplicadas = \App\ProvaRespondida::where('prova_id', $ultimaProva->id )->get();
        
        
        
        return view('admin.treinamento.provas_aplicadas', ['provas' => $provasAplicadas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provaAplicada = \App\ProvaRespondida::find($id);
        
        $prova = new \App\Services\Util\AplicacaoProva($provaAplicada->prova, $provaAplicada->user );
        
        return view('admin.treinamento.prova_aplicada', compact('prova'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
