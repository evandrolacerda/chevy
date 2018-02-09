<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PontuacaoController extends Controller {

    public function __construct() {
        $this->pontosRepository = new \App\Repositories\PontuacaoRepository();
    }

    public function invalidar($processo, $user, $mes, $ano) {
        $motivos = \App\MotivosInvalidacao::all();

        $pontuacao = $this->pontosRepository->getPontuacaoFor($user, $processo, $mes, $ano);


        if ($pontuacao == null) {
            return back()->withErrors(['Pontuação inexistente']);
        }

        return view('admin.processo.invalidar', compact('pontuacao', 'motivos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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
        //
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
        $pontuacao = $this->pontosRepository->find($id);

        try {

            $motivo = \App\MotivosInvalidacao::find($request->input('motivo'))->descricao;

            $pontuacao->invalidado = 1;
            $pontuacao->motivo_invalidacao = $motivo;
            $pontuacao->data_invalidado = \Carbon\Carbon::now();
            $pontuacao->invalidado_por = Auth::user()->name;
            $pontuacao->descricao_invalicao = $request->input('descricao_motivo');

            $pontuacao->save();

            return redirect('/admin/')->with('status', 'Pontuação invalidada com sucesso');
        } catch (\Exception $ex) {
            return back()->withErrors([$ex->getMessage()]);
        }
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

}
