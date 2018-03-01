<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

    private $usersRepo;

    public function __construct() {
        $this->usersRepo = new \App\Repositories\UsersRepository();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = $this->usersRepo->getUsers();

        return view('admin.user.index', compact('users'));
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
        $user = \App\User::findOrFail($id);


        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = \App\User::findOrFail($id);
        $chefias = \App\User::whereIn('role_id', [1, 2])->where('ativo', 1)->get();
        $funcoes = \App\Role::all();
        $regioes = \App\Regiao::all();
        $faixas = \App\Faixa::all();



        return view('admin.user.edit', compact('user', 'chefias', 'funcoes', 'faixas', 'regioes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $user = \App\User::findOrFail($id);

        try {
            $user->name = mb_strtoupper($request->input('name'));
            $user->email = $request->input('email');

            if ($request->input('chefia') != null) {
                $user->chefia_id = $request->input('chefia');
            }

            $user->role_id = $request->input('funcao');
            $user->cpf = $request->input('cpf');
            $user->regiao_id = $request->input('regiao');
            $user->cep = $request->input('cep');
            $user->rua = $request->input('rua');
            $user->numero = $request->input('numero');
            $user->bairro = $request->input('bairro');
            $user->cidade = $request->input('cidade');
            $user->estado = $request->input('estado');
            $user->telefone = $request->input('telefone');
            $user->celular = $request->input('celular');

            $user->save();

            return redirect('/admin/usuarios')->with('status', 'Usuário Atualizado com sucesso!');
        } catch (\Exception $ex) {
            return back()->withErrors([$ex->getMessage()]);
        }
    }

    public function toogleAtivo($id) {
        $user = \App\User::find($id);

        if ($user->ativo == 1) {
            $user->ativo = 0;
            $user->save();
            return redirect('/admin/usuarios')->with('status', 'Usuário inativado');
        }

        $user->ativo = 1;
        $user->save();
        return redirect('/admin/usuarios')->with('status', 'Usuário ativado');
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
