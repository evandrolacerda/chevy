<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormPlanilhaMetasRequest;

class P1MetasEnvioController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPlanilhaMetasRequest $request)
    {
        $request->persist();
        
        return redirect('/planejamento')->with('status', 'Arquivo enviado com sucesso!');
    }

    
}
