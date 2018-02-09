<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Services\Util\Calendar;
use Illuminate\Support\Facades\Auth;
use App\Repositories\ProcessoRepository;
use App\Processo;
use App\Role;

class IndexController extends Controller {

    private $user;
    private $currentMonth;
    private $year;
    private $processos;
    private $processoRepo;

    public function __construct() {
        $this->user = Auth::user();
        $this->currentMonth = date('F');
        $this->year = date('Y');
        $this->middleware('auth');

        $this->processoRepo = new ProcessoRepository(new Processo(), new Role());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //dd( Auth::user() );
        $service = new \App\Services\ProcessoOneService($this->processoRepo);

        $processos = $this->processoRepo->getProcessosForRole(Auth::user()->role);

        
        return view('index.index')->with([
                    'processos' => $processos
        ]);
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
        //
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
