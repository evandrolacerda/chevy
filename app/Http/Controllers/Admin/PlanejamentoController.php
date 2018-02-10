<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Arquivo;


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
        $ano = date('Y');
        
        if( $request->query('ano')){
            $ano = (int) $request->query('ano');
        }
        if( $request->query('mes')){
            $mes = (int) $request->query('mes');
        }
        
        $repo = new \App\Repositories\ArquivosRepository();
        
        
        $visitas    = $repo->getArquivosBy($mes, $ano, Arquivo::FILE_PLANILHA_VISITAS );
        $metas      = $repo->getArquivosBy($mes, $ano, Arquivo::FILE_PLANILHA_METAS );
        
        return view('admin.planejamento.index', compact('visitas', 'metas'));
    }

    
        /**
     * Show the form to inalidate the file
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $arquivo = \App\Arquivo::findOrFail($id);
        
        
        return view('admin.planejamento.edit', compact($arquivo));
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        
    }
}
