<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class VisitasController extends Controller
{
    
    private $usersRepo;
    private $utilAlbum;

    public function __construct() {
        
        $this->usersRepo = new \App\Repositories\UsersRepository();

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ano = date('Y');
        $mes = date('m');
        
        if( $request->query('mes')){
            $mes = $request->query('mes');
        }

        if( $request->query('ano')){
            $ano = $request->query('ano');
        }

        $users = array_column($this->usersRepo->getUsers()->toArray(), 'id');

        
        
        $albums = \App\Services\Util\Albums::getAlbums($users, $mes, $ano);
        
        
        
        return view('admin.visitas.index', compact('albums', 'mes', 'ano'));
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
