<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TreinamentoController extends Controller
{
    private $arquivosRepo;
    private $provaRepo;
            
    public function __construct() {
        
        $this->arquivosRepo = new \App\Repositories\ArquivosRepository();
        $this->provaRepo = new \App\Repositories\ProvaRepository();
        
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
        
        $fotos = $this->arquivosRepo->getArquivosBy($mes, $ano, \App\Arquivo::FILE_FOTO_TREINAMENTO);
        $atas = $this->arquivosRepo->getArquivosBy($mes, $ano, \App\Arquivo::FILE_ATA_TREINAMENT0);
        
        return view('admin.treinamento.ata', compact('atas', 'fotos'));
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
        //
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
