<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VisitasDetalhesController extends Controller
{
    public function store( Request $request) {
        
        return $request->all();
    }
}