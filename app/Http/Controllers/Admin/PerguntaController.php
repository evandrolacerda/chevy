<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerguntaController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $perguntas = \App\Pergunta::all();

        return view('admin.pergunta.index', compact('perguntas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $processos = \App\Processo::all();
        return view('admin.pergunta.create', compact('processos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'processo' => 'required',
            'pergunta' => 'required'
        ]);


        try {
            $pergunta = new \App\Pergunta();


            $pergunta->pergunta = $request->input('pergunta');
            $pergunta->processo_id = $request->input('processo');
            
            $pergunta->save();
            
            return redirect('/admin/pergunta')->with('status', 'Pergunta cadastrada com sucesso');
        } catch (\Exception $exc) {
            throw new \Exception($exc);
        }
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
        $pergunta = \App\Pergunta::findOrFail($id);
        $processos = \App\Processo::all();
        return view('admin.pergunta.edit', compact('processos', 'pergunta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $pergunta = \App\Pergunta::findOrFail($id);
        
        try{
            $pergunta->pergunta = $request->input('pergunta');
            $pergunta->processo_id = $request->input('processo');
            
            
            $pergunta->save();
            
            
            return redirect('/admin/pergunta')->with('status', 'Pergunta atualizada com sucesso');
            
        } catch (\Exception $ex) {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $pergunta = \App\Pergunta::findOrFail( $id );
        
        //dd(request()->all());
        try{
            $pergunta->delete();
            
            return response()->json(['success' => true ]);
        } catch (\Exception $ex) {
            
        }
    }

}
