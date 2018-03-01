<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PontosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pontosPorProcesso = \App\Processo::with('roles')->get();
        
        
        
        return view('admin.roles_processos.index', ['pontos' => $pontosPorProcesso]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $funcoes = \App\Role::all();
        $processos = \App\Processo::all();
        
        
        return view('admin.roles_processos.create', compact('funcoes', 'processos'));
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
            'processo' => 'required',
            'funcao' => 'required',
            'pontos' => 'required'
        ]);
        
        try {
            $processo = \App\Processo::find($request->input('processo'));


            $role = \App\Role::find($request->input('funcao'));


            $processo->roles()->save($role, ['pontos' => $request->input('pontos')]);
        } catch (\Illuminate\Database\QueryException $exc) {
            return back()->withErrors(['Já existe um registro para esse processo e função']);
        }



        return redirect('/admin/pontos')->with('status', 'Pontos por Processo cadastrada com sucesso');
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
        $processo = \App\Processo::findOrFail($id);
        
        return view('admin.roles_processos.edit', compact('processo'));
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
        $this->validate($request,[
            'funcao.*' => 'required',
            'pontos.*' => 'required'
        ]);
        
        $processo = \App\Processo::find($id);
        
        foreach ( $request->funcao as $key => $value )
        {
            $processo->roles()->updateExistingPivot($key, ['pontos' => $request->input('pontos')[$key] ]);
            
        }
        
        return redirect('/admin/pontos')->with('status', 'Pontos por processo atualizadas');
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
