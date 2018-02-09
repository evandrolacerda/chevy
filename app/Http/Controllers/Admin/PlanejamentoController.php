<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlanejamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        
        $mes = date('m');
        $ano = date('y');
        
        if( $request->query('ano')){
            $ano = (int) $request->query('ano');
        }
        if( $request->query('mes')){
            $mes = (int) $request->query('mes');
        }
        
        $repo = new \App\Repositories\EnviosProcessoOneRepository( new \App\ProcessoOneEnvios());
        $visitas = $repo->getPlanilhasVisitas($mes, $ano);
        $metas = $repo->getPlanilhasMetas($mes, $ano);
        
                
        return view('admin.planejamento.index', compact('visitas', 'metas'));
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
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form to inalidate the file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arquivo = \App\ProcessoOneEnvios::findOrFail($id);
        
        
        return view('admin.planejamento.edit', compact($arquivo));
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
        $arquivo = \App\ProcessoOneEnvios::findOrFail($id);
        
        
    }
}
