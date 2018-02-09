<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcessosController extends Controller {

    public function index() {
        $user = Auth::user();
        
        $processo = new \App\Processo();
        $role = new \App\Role();
        
        $processosRepo = new \App\Repositories\ProcessoRepository($processo, $role);

        $processos = $processosRepo->getProcessosForRole(
                Auth::user()->role)->toArray();
        
        return $processos;
    }

}
