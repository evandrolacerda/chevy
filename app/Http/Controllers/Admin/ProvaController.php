<?php

namespace App\Http\Controllers\Admin    ;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProvaController extends Controller
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
        
        
        $provas = $this->provasRepo->all();
        
        return view('admin.prova.index', compact('provas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.prova.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'questao.*' => 'required',
            'mes' => 'required',
            'ano' => 'required'
        ]);
        
        $prova = new \App\Prova();
        
        $prova->mes = $request->input('mes');
        $prova->ano = $request->input('ano');
        
        $prova->save();
        
        
        
        foreach ( $request->input('questao') as $questao )
        {
            $perguntaModel = new \App\Pergunta();
            $perguntaModel->pergunta = $questao;            
            $prova->perguntas()
                    ->save($perguntaModel);
        }
        
      return redirect('/admin/treinamento');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prova = \App\Prova::find($id);
        
        return view('admin.prova.show', compact('prova'));
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
